<template>
	<section id="clients">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-12 text-center">
	                <h2 class="section-heading">Alguns de nossos clientes</h2>
	                <hr class="primary">
	            </div>
	        </div>
	    </div>
	    <div class="container">
	        <div class="row" v-if="clients.length > 0">
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[0].imageUrl" alt="" @click="edit(clients[0])">
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[1].imageUrl" alt="" @click="edit(clients[1])">
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[2].imageUrl" alt="" @click="edit(clients[2])">
	                </div>
	            </div>
	        </div>
	        <div class="row" v-if="clients.length > 0">
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[3].imageUrl" alt="" @click="edit(clients[3])">
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[4].imageUrl" alt="" @click="edit(clients[4])">
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[5].imageUrl" alt="" @click="edit(clients[5])">
	                </div>
	            </div>
	        </div>
	        <div class="row" v-if="clients.length > 0">
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[6].imageUrl" alt="" @click="edit(clients[6])">
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[7].imageUrl" alt="" @click="edit(clients[7])">
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 text-center">
	                <div class="service-box">
	                    <img :src="clients[8].imageUrl" alt="" @click="edit(clients[8])">
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="container">
            <div v-if="isAuth" class="modal fade" id="clients_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" 
                                class="close" 
                                data-dismiss="modal" 
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Imagens disponíveis no servidor</h4>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#client_select">Editar</a></li>
                                <li><a data-toggle="tab" href="#client_remove">Remover Imagem</a></li>
                                <li><a data-toggle="tab" href="#client_add">Adicionar Imagem</a></li>
                            </ul>
                            <div class="tab-content">
                                <br>
                                <div id="client_select" class="tab-pane fade in active">
                                    <select name="" id="select_client_image">
                                        <option width="150px" v-for="image in images"
                                          :data-img-src="'/img/clientes/' + image"
                                          :data-img-alt="image"
                                          :data-img-label="image | limit(13)"
                                          :value="'/img/clientes/' + image"
                                        />
                                    </select>
                                </div>
                                <div id="client_remove" class="tab-pane fade">
                                    <div class="form-group">
                                        <button type="button" 
                                            class="form-control btn btn-danger" 
                                            @click="removeImages">
                                            Remover
                                        </button>
                                    </div>
                                    <select name="" id="remove_client_image" multiple="multiple">
                                        <option width="150px" v-for="image in images"
                                          :data-img-src="'/img/clientes/' + image"
                                          :data-img-alt="image"
                                          :data-img-label="image | limit(13)"
                                          :value="'/img/clientes/' + image"
                                        />
                                    </select>
                                </div>
                                <div id="client_add" class="tab-pane fade">
                                    <div class="form-group">
                                        <input type="file" 
                                            class="form-control" 
                                            placeholder="Enviar imagem para o servidor" 
                                            @change="newImageToSend" />
                                    </div>
                                    <div class="form-group">
                                        <button type="button" 
                                            class="form-control btn btn-primary" 
                                            @click="sendImage">
                                            Enviar
                                        </button>
                                    </div>
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
</template>	

<script>
	import StringLimitFilter from '../../filters/string_limit'

    export default {
    	data() {
            return {
                clientEditable: {},
                newImage: '',
                imageToSend: '',
                imagesToRemove: []
            }
        },
    	filters: {
            'limit' : StringLimitFilter
        },
    	methods: {
            edit(client) {
                if (this.isAuth) {
                    self = this
                    self.clientEditable = client
                    self.$store.dispatch('load-clients-image').then((data) => {
                        $('#select_client_image').imagepicker({
                            show_label  : true,
                            selected: (select, pickeroption, event) => {
                                self.clientEditable.imageUrl = select.value()
                                self.clientEditable.fullImageUrl = select.value()
                                this.$store.dispatch('update-client', self.clientEditable)
                                $('#clients_modal').modal('hide')
                            }
                        })
                        $('#remove_client_image').imagepicker({
                            selected: (select, pickeroption, event) => {
                                self.imagesToRemove.push(select.value())
                            }
                        })
                        $('#clients_modal').modal('show')
                    })
                }
            },
            removeImages() {
                this.imagesToRemove.forEach(val => {
                    this.$store.dispatch('destroy-client-image', val)
                })
                $('#clients_modal').modal('hide')
            },
            warning() {
                toastr["warning"]("Você está no modo de exclusão, ao clicar na imagem ela será excluida do servidor.", "Atenção")
            },
            sendImage() {
                this.$store.dispatch('save-client-image', this.imageToSend)
            },
            newImageToSend(ev) {

                this.imageToSend = ev.target.files[0]
            }
        },
        computed: {
            clients() {
                return this.$store.state.clients
            },
            images() {
                return this.$store.state.clientsImage
            },
            isAuth() {
                return this.$store.state.authenticated
            }
        }
    }
</script>