import toastr from './toastr'

module.exports = function(request){
  return request.then(function(response) {
    toastr["success"](response.data.message, response.statusText)
    return response.data
  }, function(response) {
    if (response.status == 412 || response.status == 422) {
      Object.keys(response.data).forEach(function (key) {
        let error = ''
        response.data[key].forEach(function(el) {
          error += el + '<br/>'
        })
        toastr["error"](error, response.statusText)
      });
    } else {
      toastr["error"](response.data, response.statusText)
    }
    return false
  })
}