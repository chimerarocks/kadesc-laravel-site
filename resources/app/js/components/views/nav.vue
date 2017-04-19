<template>
	<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
		        </button>
		        <a class="navbar-brand page-scroll" href="#page-top">
		        	<img :src="logoUrl" height="50px" width="200px"> </img>
		        </a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		        <ul class="nav navbar-nav navbar-right">
		            <li>
		                <a class="page-scroll" href="#about">A Empresa</a>
		            </li>
		            <li>
		                <a class="page-scroll" href="#services">Serviços</a>
		            </li>
		            <li>
		                <a class="page-scroll" href="#clients">Clientes</a>
		            </li>
		            <li>
		                <a class="page-scroll" href="#contact">Contato</a>
		            </li>
		            <li v-show="isAuth">
		                <a href="#" @click.prevent="logout"> 
		                <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		            </li>
		            <li v-show="!isAuth">
		                <a href="#" data-toggle="modal" data-target="#login"> 
		                <i class="fa fa-sign-in" aria-hidden="true"></i></a>
		            </li>
		        </ul>
		    </div>
		    <!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
</template>

<script>
	import ScrollReveal from 'scrollreveal'

	export default {
		mounted() {
			$ = window.$
			// jQuery for page scrolling feature - requires jQuery Easing plugin
		    $(document).on('click', 'a.page-scroll', function(event) {
		        var $anchor = $(this);
		        $('html, body').stop().animate({
		            scrollTop: ($($anchor.attr('href')).offset().top - 50)
		        }, 1250, 'easeInOutExpo');
		        event.preventDefault();
		    });

		    // Highlight the top nav as scrolling occurs
		    $('body').scrollspy({
		        target: '.navbar-fixed-top',
		        offset: 51
		    });

		    // Closes the Responsive Menu on Menu Item Click
		    $('.navbar-collapse ul li a').click(function() {
		        $('.navbar-toggle:visible').click();
		    });

		    // Offset for Main Navigation
		    $('#mainNav').affix({
		        offset: {
		            top: 100
		        }
		    })

		    

		    // Initialize and Configure Scroll Reveal Animation
		    window.sr = ScrollReveal();
		    // sr.reveal('.sr-icons', {
		    //     duration: 600,
		    //     scale: 0.3,
		    //     distance: '0px'
		    // }, 200);
		    sr.reveal('.sr-button', {
		        duration: 1000,
		        delay: 200
		    });
		    sr.reveal('.sr-contact', {
		        duration: 600,
		        scale: 0.3,
		        distance: '0px'
		    }, 300);

		    // Initialize and Configure Magnific Popup Lightbox Plugin
		    $('.popup-gallery').magnificPopup({
		        delegate: 'a',
		        type: 'image',
		        tLoading: 'Loading image #%curr%...',
		        mainClass: 'mfp-img-mobile',
		        gallery: {
		            enabled: true,
		            navigateByImgClick: true,
		            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
		        },
		        image: {
		            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
		        }
		    });
		},
		computed: {
            logoUrl() {
                return this.$store.state.page.logoUrl
            },
            isAuth() {
                return this.$store.state.authenticated
            }
        },
        methods: {
        	logout() {
        		this.$store.dispatch('logout')
        	}
        }
	}
</script>