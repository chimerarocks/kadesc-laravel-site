import Vue from 'vue'
import requestToastr from './requestToastr'
import blockUiService from './blockUI'

function paramsHandle(uri, field) {
  if (uri.indexOf('?') > -1) {
    return uri += '&' + field
  } else {
    return uri += '?' + field
  }
}

function handleSearchParam(route, search) {
  route = paramsHandle(route, 'search=')
  Object.keys(search).forEach(function (field) {
    route += field + ':' + search[field] + ','
  })
  return route.slice(0, -1)
}

function handleIncludeParam(route, includes) {
  route = paramsHandle(route, 'include=')
  includes.forEach(function(el) {
    route += el + ','
  })
  return route.slice(0, -1)
}

function handleRequest(route, o) {
  if (o && o.search) {
    route = handleSearchParam(route, o.search)
  }
  if (o && o.includes instanceof Array && o.includes.length > 0) {
    route = handleIncludeParam(route, o.includes)
  }
  return route
}

function handleToastr(toastr, request) {
  if (toastr) {
    return requestToastr(request)
  }
  return request
}

function blockUIRequest(request) {
    blockUiService.blockUI({
      boxed: true,
      message: 'Carregando...'
    });
    return request.then(data => {
      blockUiService.unblockUI();
      return data
    }, err => {
      blockUiService.unblockUI();
      return false
    })
}

module.exports = {
  get: function(route, o, toastr) {
    route = handleRequest(route, o)
    return blockUIRequest(handleToastr(toastr, Vue.http.get(route)))
  },
  post: function(route, dataset, o, toastr) {
    route = handleRequest(route, o)
    return blockUIRequest(handleToastr(toastr, Vue.http.post(route, dataset)))
  },
  put: function(route, dataset, o, toastr) {
    route = handleRequest(route, o)
    return blockUIRequest(handleToastr(toastr, Vue.http.put(route, dataset)))
  },
  delete: function(route, o, toastr) {
    route = handleRequest(route, o)
    return blockUIRequest(handleToastr(toastr, Vue.http.delete(route)))
  }
}