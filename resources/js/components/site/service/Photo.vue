<template>
    <div>
        <div class="title">Фото</div>
        <silent-box :gallery="photos" class="image"></silent-box>
    </div>
</template>
<script>

export default {
    props: {
        photos: Array
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
        width: 240px;
    }
    .title {
        color: #373B53;
        font-weight: 500;
        font-size: 30px;
        margin-bottom: 20px;
    }
</style>
