<template>
    <div>
        <div class="title">Фото</div>
        <silent-box :gallery="gallery" class="image"></silent-box>
    </div>
</template>
<script>

export default {
    data() {
        return {
            gallery: [
                {
                    src: '/img/news1.png'
                },
                {
                    src: '/img/news2.png'
                },
                {
                    src: '/img/news3.png',
                },
            ]
        };
    },
    components: {
        VueSilentbox
    },
}
</script>
<style lang="css">
    #silentbox-gallery {
        display: flex;
    }
    #silentbox-gallery .silentbox-item {
        margin: 10px;
    }
    .silentbox-item img {
        border-radius: 10px;
    }
    .title {
        color: #373B53;
        font-weight: 500;
        font-size: 30px;
        margin-bottom: 20px;
    }
</style>
