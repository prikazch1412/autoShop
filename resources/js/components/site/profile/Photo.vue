<template>
    <div>
        <div class="upload-files">
            <b-form-file
                v-model="file"
                placeholder="Виберіть файл..."
                drop-placeholder="Перетягніть файл сюди..."
                multiple
            ></b-form-file>
        </div>
        <b-row>
            <b-col cols="4" v-for="i in 5" :key="i" class="photo-item mb-4">
                <b-icon class="del-photo" icon="x" font-scale="1.5"></b-icon>
                <img src="/img/news.png" alt="">
            </b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            file: false
        }
    }
}
</script>
<style lang="css" scoped>
    .upload-files {
        margin-bottom: 20px;
    }
    .del-photo {
        position: absolute;
        right: 15px;
        color: #ffffff;
        background: #000000;
        border-radius: 0 10px 0 0;
    }
    .photo-item img {
        width: 100%;
        border-radius: 10px;
    }
</style>
