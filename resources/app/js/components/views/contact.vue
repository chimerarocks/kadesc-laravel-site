<template>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Solicite um orçamento!</h2>
                    <hr class="primary">
                </div> 
                    <div class="col-lg-4 col-lg-offset-2 text-center">
                        <div class="form-group">
                            <input placeholder="Nome" type="text" size="40" v-model="form.name"/>
                        </div>
                        <div class="form-group">
                            <input placeholder="Email" type="text" size="40" v-model="form.email"/>
                        </div>
                        <div class="form-group">
                            <input placeholder="Telefone" onfocus="tel.value='(051) '" type="text" size="40" v-model="form.phone"/>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="form-group">
                            <textarea placeholder="Mensagem" style="resize:none;" rows="6" cols="31" v-model="form.formMessage"/>
                        </div>
                    </div>
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <input class="btn btn-primary" type="submit" @click.prevent="send" value="Enviar">
                        <input class="btn btn-default" type="reset" @click.prevent="reset" value="Apagar"></td>
                    </div> 
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>{{contactPhone}}</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a :href="'mailto:' + contactEmail">{{contactEmail}}</span></a></p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    formMessage: ''
                }
            }
        },
        computed: {
            contactEmail() {
                return this.$store.state.page.contactEmail
            },
            contactPhone() {
                return this.$store.state.page.contactPhone
            }
        },
        methods: {
            reset() {
                this.form = {
                    name: '',
                    email: '',
                    phone: '',
                    formMessage: ''
                }
            },
            send() {
                this.$store.dispatch('send-email', this.form)
            }
        }
    }
</script>