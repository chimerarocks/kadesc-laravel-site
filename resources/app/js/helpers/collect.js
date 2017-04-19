module.exports = function() {
  var ret = {};
  var len = arguments.length;
  for (var i=0; i<len; i++) {
    for (let p in arguments[i]) {
      if (arguments[i].hasOwnProperty(p)) {
        ret[p] = arguments[i][p];
      }
    }
  }
  return ret;
}
