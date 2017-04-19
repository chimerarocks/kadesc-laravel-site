<style scoped>
    img {
        height: auto; 
        width: 100%; 
        max-height: 290px;
    }
</style>

<template>
    <a :href="fullImage" class="portfolio-box">
        <img :src="image" class="img-responsive" :alt="company">
        <div class="portfolio-box-caption">
            <div class="portfolio-box-caption-content">
                <div class="project-category text-faded">
                    Construtora: {{company}}
                </div>
                <div class="project-name">
                    Obra: {{building}}
                </div>
            </div>
        </div>
    </a>
</template>

<script>
    export default {
        props: ['fullImage', 'image', 'building', 'company']
    }
</script>


<!-- <a href="/public/img/portfolio/fullsize/1.jpg" class="portfolio-box">
    <img src="/public/img/obras/vivare.jpg" class="img-responsive" alt="">
    <div class="portfolio-box-caption">
        <div class="portfolio-box-caption-content">
            <div class="project-category text-faded">
                Obra: Terrabela
            </div>
            <div class="project-name">
                Construtora: Goldztein/Living
            </div>
        </div>
    </div>
</a> -->