export default {
  'set-authenticated'(state) {
    state.authenticated = true
  },
  'set-unauthenticated'(state) {
    state.authenticated = false
  },
  'set-authenticated-user'(state, user) {
    state.user = user
  }
}