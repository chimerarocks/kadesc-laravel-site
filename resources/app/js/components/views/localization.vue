<template>
    <aside class="bg-dark" id="localization">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Localização</h2>
                    <hr class="light">
                    <center>
                        <small>
                        {{localization}}<br>
                        <br>
                        <br>
                        </small>
                        <a :href="localizationMapUrl" target="_blank">Ver mapa</a>
                        <br>
                        <!-- <iframe width="562" height="314" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com.br/maps?cbp=13,307.13,,0,-5.97&amp;layer=c&amp;panoid=Fc568lpzCceBmfBDqyYyew&amp;cbll=-29.92573,-51.055967&amp;dg=opt&amp;ie=UTF8&amp;t=m&amp;ll=-29.979175,-51.056213&amp;spn=0.18676,0.385895&amp;z=11&amp;source=embed&amp;output=svembed"></iframe> -->
                    </center>
                </div>
            </div>
        </div>
    </aside>
</template>

<script>
    export default {
        computed: {
            localization() {
                return this.$store.state.page.localization
            },
            localizationMapUrl() {
                return this.$store.state.page.localizationMapUrl
            }
        }
    }
</script>