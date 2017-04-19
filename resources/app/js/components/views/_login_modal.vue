<template>
	<div class="modal fade" id="login" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Acesso restrito</h4>
	      </div>
	      <div class="modal-body">
            
            <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                	<label for="email" class="col-md-6 control-label">E-Mail</label>
                    <div class="row">
                        <input 
                            v-model="credentials.username"
                            @keyup.enter="login"
                            type="email" class="form-control"
                            required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-6 control-label">Senha</label>
                    <div class="row">
                        <input
                            v-model="credentials.password"
                            @keyup.enter="login"
                            type="password" class="form-control"
                            required>
                    </div>
                </div>
            </div>
            </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" @click="login">Login</button>
	      </div>
	    </div>
	  </div>
	</div>
</template>

<script>
    export default {
        data() {
          return {
            credentials: {
              client_id: 2,
              grant_type: 'password',
              scope: '',
              client_secret: 'QWVjro1n0oAjR6WntxQU0cFkUzlLeBKqXu2oW9ZG',
              username: '',
              password: '',
            }
          }
        },
        methods: {
          login() {
            this.$store.dispatch('authenticate', this.credentials).then((isAuth) => {
                if (isAuth) {
                    $('#login').modal('hide')
                }
            })
          }
        }
      }
</script>