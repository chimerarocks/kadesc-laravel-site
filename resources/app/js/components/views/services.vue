<style>
.thumbnail>img {
    display: block;
    max-width: 150px;
    min-width: 150px;
    min-height: 150px;
    height: auto;
    max-height: 150px;
}
</style>

<template>
    <section class="no-padding" id="services">
        <div class="container-fluid">
            <service-row :services="services[0]" lg=4 md=4 sm=4 v-on:serviceChosen="edit"></service-row>
            <service-row :services="services[1]" lg=4 md=4 sm=4 v-on:serviceChosen="edit"></service-row>
            <service-row :services="services[2]" lg=4 md=4 sm=4 v-on:serviceChosen="edit"></service-row>
        </div>
        <div class="container">
            <div v-if="isAuth" class="modal fade" id="services_modal" tabindex="-1" role="dialog">
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
                                <li class="active"><a data-toggle="tab" href="#selecao">Editar</a></li>
                                <li><a data-toggle="tab" href="#remocao">Remover Imagem</a></li>
                                <li><a data-toggle="tab" href="#novaimage">Adicionar Imagem</a></li>
                            </ul>
                            <div class="tab-content">
                                <br>
                                <div id="selecao" class="tab-pane fade in active">
                                    <div>
                                        <div class="form-group">
                                            <input type="text" 
                                                class="form-control" 
                                                placeholder="Obra" 
                                                v-model='serviceEditable.building' /> 
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <input type="text" 
                                                class="form-control" 
                                                placeholder="Construtora"
                                                v-model='serviceEditable.company' /> 
                                        </div>
                                    </div>  
                                    <select name="" id="select_service_image">
                                        <option width="150px" v-for="image in images"
                                          :data-img-src="'/img/obras/' + image"
                                          :data-img-alt="image"
                                          :data-img-label="image | limit(13)"
                                          :value="'/img/obras/' + image"
                                        />
                                    </select>
                                </div>
                                <div id="remocao" class="tab-pane fade">
                                    <div class="form-group">
                                        <button type="button" 
                                            class="form-control btn btn-danger" 
                                            @click="removeImages">
                                            Remover
                                        </button>
                                    </div>
                                    <select name="" id="remove_service_image" multiple="multiple">
                                        <option width="150px" v-for="image in images"
                                          :data-img-src="'/img/obras/' + image"
                                          :data-img-alt="image"
                                          :data-img-label="image | limit(13)"
                                          :value="'/img/obras/' + image"
                                        />
                                    </select>
                                </div>
                                <div id="novaimage" class="tab-pane fade">
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
    import ServiceRow from '../service-row.vue'
    import toastr     from '../../services/toastr'
    import StringLimitFilter from '../../filters/string_limit'

    export default {
        components: {
            ServiceRow
        },
        filters: {
            'limit' : StringLimitFilter
        },
        data() {
            return {
                serviceEditable: {},
                newImage: '',
                imageToSend: '',
                imagesToRemove: []
            }
        },
        methods: {
            edit(service) {
                if (this.isAuth) {
                    self = this
                    self.serviceEditable = service
                    self.$store.dispatch('load-services-image').then((data) => {
                        $('#select_service_image').imagepicker({
                            show_label  : true,
                            selected: (select, pickeroption, event) => {
                                self.serviceEditable.imageUrl = select.value()
                                self.serviceEditable.fullImageUrl = select.value()
                                this.$store.dispatch('update-service', self.serviceEditable)
                                $('#services_modal').modal('hide')
                            }
                        })
                        $('#remove_service_image').imagepicker({
                            selected: (select, pickeroption, event) => {
                                self.imagesToRemove.push(select.value())
                            }
                        })
                        $('#services_modal').modal('show')
                    })
                }
            },
            removeImages() {
                this.imagesToRemove.forEach(val => {
                    this.$store.dispatch('destroy-image', val)
                })
                $('#services_modal').modal('hide')
            },
            warning() {
                toastr["warning"]("Você está no modo de exclusão, ao clicar na imagem ela será excluida do servidor.", "Atenção")
            },
            sendImage() {
                this.$store.dispatch('save-service-image', this.imageToSend)
            },
            newImageToSend(ev) {

                this.imageToSend = ev.target.files[0]
            }
        },
        computed: {
            services() {
                if (this.$store.state.services.length > 0) {
                    let result = []
                    let rowLenght = this.$store.state.page.serviceRowSize
                    let rowsQuant = this.$store.state.page.serviceRowQuantity * rowLenght
                    let rows = 1
                    let i = 0
                    for (rows; rows <= rowsQuant; rows++) {
                        let row = []
                        for (i; i < rowLenght * rows ; i++) { 
                            row.push(this.$store.state.services[i])
                        }
                        result.push(row)
                    }
                    return result
                } else {
                    return []
                }
            },
            isAuth() {
                return this.$store.state.authenticated
            },
            images() {
                return this.$store.state.servicesImage
            }
        }
    }
</script>