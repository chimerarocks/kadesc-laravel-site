import resource from './resource'

function Storage(local) {
  if (local) {
    return window.localStorage
  } else {
    return window.sessionStorage
  }
}

export default {
  'authenticate'(context, creds) {
    return resource.login(creds).then(function(isAuth) {
      if (isAuth) {
        let storage = Storage(creds.remember)
        resource.setAuthorizationHeader(isAuth)
        storage.setItem('authenticated', JSON.stringify(isAuth))
        resource.getUser().then(function(response) {
          storage.setItem('user-authenticated', JSON.stringify({name: response.data.name, email: response.data.email}))
          if (creds.remember) {
            storage.setItem('remember', true)
          }
          context.commit('set-authenticated-user', response.data)
          context.commit('set-authenticated') //Deve vir por último, pois é o que gera a nova view
          window.location.reload(false);
        })
        context.commit('set-authenticated')
        return true
      } else {
        return false
      }
    })
  },
  'check-auth'(context) {
    let storage = Storage(window.localStorage.getItem('remember'))
    let authenticated = storage.getItem('authenticated')
    if (authenticated) {
      resource.setAuthorizationHeader(JSON.parse(authenticated))
      let user = storage.getItem('user-authenticated')
      context.commit('set-authenticated-user', JSON.parse(user))
      context.commit('set-authenticated')
    }
  },
  'logout'(context){
    let storage = Storage(window.localStorage.getItem('remember'))
    resource.removeAuthorizationHeader()
    storage.removeItem('authenticated')
    storage.removeItem('user-authenticated')
    storage.removeItem('remember')
    context.commit('set-authenticated-user', {})
    context.commit('set-unauthenticated')
    window.location.reload(false);
  }
}