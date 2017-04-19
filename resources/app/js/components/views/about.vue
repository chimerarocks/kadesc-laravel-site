<template>
    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">
                        <div v-show="isAuth">
                            <div class="aboutTitle-editable" v-html="aboutTitle" id="aboutTitleHtml">                                
                            </div>
                        </div>
                        <div v-show="!isAuth">
                            <div v-html="aboutTitle"></div>
                        </div>
                    </h2>
                    <hr class="light">
                    <div v-show="isAuth">
                        <div class="about-editable" v-html="about" id="aboutHtml"></div>
                    </div>
                    <div v-show="!isAuth">
                        <div v-html="about"></div>
                    </div>
                    <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Conheça nossos serviços!</a>
                </div>
            </div>
        </div>
        
    </section>
</template>

<script>
    export default {
        computed: {
            about() {
                return this.$store.state.page.about
            },
            aboutTitle() {
                return this.$store.state.page.aboutTitle
            },
            isAuth() {
                return this.$store.state.authenticated
            }
        },
        methods: {
            updateAbout() {
                let page = this.$store.state.page
                page.about = $('#aboutHtml').html()
                this.$store.dispatch('update-page', page)
            },
            updateAboutTitle() {
                let page = this.$store.state.page
                page.aboutTitle = $('#aboutTitleHtml').html()
                this.$store.dispatch('update-page', page)
            }
        },
        mounted() {
            self = this
            tinymce.init({
                selector: '.about-editable',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'bold italic | fontselect |  fontsizeselect | print preview media | forecolor backcolor emoticons',
                toolbar2: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar3: 'updateAbout',
                inline: true,
                setup: function (editor) {
                    editor.addButton('updateAbout', {
                        text: 'Atualizar',
                        icon: false,
                        onclick: function () {
                            self.updateAbout()
                        }
                    });
                },
            });
            tinymce.init({
                selector: '.aboutTitle-editable',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'bold italic | fontselect |  fontsizeselect | print preview media | forecolor backcolor emoticons',
                toolbar2: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar3: 'updateAboutTitle',
                inline: true,
                setup: function (editor) {
                    editor.addButton('updateAboutTitle', {
                        text: 'Atualizar',
                        icon: false,
                        onclick: function () {
                            self.updateAboutTitle()
                        }
                    });
                },
            });
        }
    }
</script>