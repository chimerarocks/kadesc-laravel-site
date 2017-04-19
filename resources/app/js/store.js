'use strict'

import Vue from 'vue/dist/vue.js'
import Vuex from 'vuex'
import VueResource from 'vue-resource'
import Collect from './helpers/collect'
import AuthActions from './services/auth/actions'
import AuthMutations from './services/auth/mutations'
import toastr   from './services/toastr'

Vue.use(Vuex)
Vue.use(VueResource)

const state = {
    page: {},
    services: [],
    clients: [],
    servicesImage: [],
    clientsImage: [],
    authenticated: false,
    user: {}
}

const HOST = '';

function Storage(local) {
  if (local) {
    return window.localStorage
  } else {
    return window.sessionStorage
  }
}

let mutations = {
    'set-service'(state, service) {
        let index = state.services.findIndex(element => service.id == element.id)
        if (index != -1) {
            state.services[index] = service
        }
    },
    'set-page'(state, page) {
        state.page = page
    },
    'set-services'(state, services) {
        state.services = services
    },
    'set-services-image'(state, images) {
        state.servicesImage = images
    },
    'remove-service-image'(state, image) {
        let index = state.servicesImage.findIndex(element => {
            return image == '/img/obras/' + element
        })
        if (index != -1) {
            state.servicesImage = state.servicesImage.splice(index, 1)
        }
    },
    'add-service-image'(state, image) {
        let index = state.servicesImage.push(image)
    },
    'set-clients-image'(state, images) {
        state.clientsImage = images
    },
    'remove-client-image'(state, image) {
        let index = state.clientsImage.findIndex(element => {
            return image == '/img/clientes/' + element
        })
        if (index != -1) {
            state.clientsImage = state.clientsImage.splice(index, 1)
        }
    },
    'add-client-image'(state, image) {
        let index = state.clientsImage.push(image)
    },
    'set-clients'(state, clients) {
        state.clients = clients
    }
}

let actions = {
    'load-page'(context) {
        Vue.http.get(HOST + '/api/pages/1').then(response => {
            let page = response.data
            context.commit('set-page', page)
        })
    },
    'update-page'(context, dataset) {
        Vue.http.put(HOST + '/api/pages/1', dataset).then(response => {
            toastr["success"]('Layout da página atualizado.', 'OK')
            let page = response.data
            context.commit('set-page', page)
        }, error => {
            toastr["error"](response.data.message, response.statusText)
        })
    },
    'update-service'(context, dataset) {
        Vue.http.put(HOST + '/api/services/' + dataset.id, dataset).then(response => {
            toastr["success"]('Serviço atualizado.', 'OK')
            let service = response.data
            context.commit('set-service', service)
        }, error => {
            toastr["error"](error.data.message, error.statusText)
        })
    },
    'load-services'(context) {
        Vue.http.get(HOST + '/api/services').then(response => {
            let services = response.data
            context.commit('set-services', services)
        })
    },
    'load-services-image'(context) {
        return Vue.http.get(HOST + '/api/images/obras').then(response => {
            let images = response.data
            context.commit('set-services-image', images)
            return images
        })
    },
    'save-service-image'(context, dataset) {
        let form = new FormData()
        form.append('photo', dataset)
        return Vue.http.post(HOST + '/api/images/obras', form).then(response => {
            let images = response.data
            toastr["success"]('Imagem enviada para o servidor.', 'OK')
            context.commit('add-service-image', images)
            return images
        })
    },
    'destroy-image'(context, path) {
        return Vue.http.delete(HOST + '/api/images?path=' + path).then(response => {
            context.commit('remove-service-image', path)
            toastr["success"]('Imagem removida com sucesso.', 'OK')
        })
    },
    'update-client'(context, dataset) {
        Vue.http.put(HOST + '/api/clients/' + dataset.id, dataset).then(response => {
            toastr["success"]('Cliente atualizado.', 'OK')
            let client = response.data
            context.commit('set-client', client)
        }, error => {
            toastr["error"](error.data.message, error.statusText)
        })
    },
    'load-clients'(context) {
        Vue.http.get(HOST + '/api/clients').then(response => {
            let clients = response.data
            context.commit('set-clients', clients)
        })
    },
     'load-clients-image'(context) {
        return Vue.http.get(HOST + '/api/images/clientes').then(response => {
            let images = response.data
            context.commit('set-clients-image', images)
            return images
        })
    },
    'save-client-image'(context, dataset) {
        let form = new FormData()
        form.append('photo', dataset)
        return Vue.http.post(HOST + '/api/images/clientes', form).then(response => {
            let images = response.data
            toastr["success"]('Imagem enviada para o servidor.', 'OK')
            context.commit('add-client-image', images)
            return images
        })
    },
    'destroy-client-image'(context, path) {
        return Vue.http.delete(HOST + '/api/images?path=' + path).then(response => {
            context.commit('remove-client-image', path)
            toastr["success"]('Imagem removida com sucesso.', 'OK')
        })
    },
    'send-email'(context, form) {
        return Vue.http.post(HOST + '/api/mail', form).then(response => {
            toastr["success"]('Email enviado com suceso.', 'OK')
        }, error => {
            console.log(error)
            for (var property in error.data) {
                if (error.data.hasOwnProperty(property)) {
                    error.data[property].forEach(x => {
                        toastr["error"](x, 'Erro.')
                    })
                }
            }
        })
    }
}

export default new Vuex.Store({
    state,
    mutations   :   Collect(mutations, AuthMutations),
    actions     :   Collect(actions, AuthActions)
})