import toastr from '../toastr'
import Vue from 'vue/dist/vue.js'

const HOSTAUTH = '';

export default {
  login(creds) {
    return Vue.http.post(HOSTAUTH + '/oauth/token', creds).then((response) => {
      toastr["success"]('Autenticação realizada com sucesso', 'OK')
      return response.data
    }, function(response) {
      toastr["error"](response.data.message, response.statusText)
      return false
    })
  },
  removeAuthorizationHeader() {
    Vue.http.interceptors.pop()
  },
  setAuthorizationHeader(data) {
    Vue.http.interceptors.push((request, next)  => {
      request.headers.set('Authorization', 'Bearer ' + data.access_token)
      next()
    });
  },
  getUser: function() {
    return Vue.http.get(HOSTAUTH + '/api/user')
  }
}