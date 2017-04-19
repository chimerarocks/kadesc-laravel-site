<template>
	<header>
	    <div class="header-content">
	        <div class="header-content-inner">
	            <h1 id="homeHeading">
	            	<div v-show="isAuth">
                        <div class="apresentation-editable" v-html="apresentation" id="apresentationHtml"></div>
                    </div>
                    <div v-show="!isAuth">
                        <div v-html="apresentation"></div>
                    </div>
	            </h1>
	            <hr>
	            <!-- <p>Start Bootstrap can help you build better websites using the Bootstrap CSS framework! Just download your template and start going, no strings attached!</p> -->
	            <a href="#about" class="btn btn-primary btn-xl page-scroll">Saiba mais</a>
	        </div>
	    </div>
	</header>
</template>

<script>
    export default {
        computed: {
            apresentation() {
                return this.$store.state.page.apresentation
            },
            isAuth() {
                return this.$store.state.authenticated
            }
        },
        methods: {
            updateApresentation() {
            	let page = this.$store.state.page
            	page.apresentation = $('#apresentationHtml').html()
                this.$store.dispatch('update-page', page)
            }
        },
        mounted() {
            let selfApresentation = this
            tinymce.init({
                selector: '.apresentation-editable',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'bold italic | fontselect |  fontsizeselect | print preview media | forecolor backcolor emoticons',
                toolbar2: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar3: 'updateApresentation',
                inline: true,
                setup: function (editor) {
                    editor.addButton('updateApresentation', {
                        text: 'Atualizar',
                        icon: false,
                        onclick: function () {
                            selfApresentation.updateApresentation()
                        }
                    });
                },
            });
        }
    }
</script>