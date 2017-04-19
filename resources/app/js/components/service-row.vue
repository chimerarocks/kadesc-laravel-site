<template>
    <div class="row no-gutter " :class="{'popup-gallery': !isAuth}">
        <div v-for="service in services" :class="classes" @click.prevent='serviceChosen(service)'>
            <service 
                :full-image="service.fullImageUrl" 
                :image="service.imageUrl" 
                :building="service.building" 
                :company="service.company">
            </service>
        </div>
    </div> 
</template>

<script>
    import Service from './service.vue'

    export default {
        props: ['services', 'lg', 'sm', 'md'],
        computed: {
            classes() {
                let c = ''
                if (this.lg != undefined && this.lg != '') {
                    c += 'col-lg-' + this.lg
                }
                if (this.sm != undefined && this.sm != '') {
                    c += ' col-sm-' + this.sm
                }
                if (this.md != undefined && this.md != '') {
                    c += ' col-md-' + this.md
                }
                return c
            },
            isAuth() {
                return this.$store.state.authenticated
            }
        },
        components: {
            Service
        },
        methods: {
            serviceChosen(service) {
                this.$emit('serviceChosen', service)
            }
        }
    }
</script>