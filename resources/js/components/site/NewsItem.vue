<template>
    <div>
        <b-row v-for="(item, index) in data" :key="index" class="news-item">
            <b-col cols="4">
                <div class="news-img">
                    <img :src="item.photo" alt="">
                </div>
            </b-col>
            <b-col cols="6">
                <div class='title'>
                    {{ item.title }}
                </div>
                <div class="descriprion" v-html="item.description"></div>
            </b-col>
            <b-col cols="2" class="next">
                <div>
                    <router-link :to="'/news/'+item.id"><img src="/img/next.png" alt=""> Далі</router-link>
                </div>
            </b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    props: {
        data: Array
    }
}
</script>
<style lang="css" scoped>
    .news-item {
        margin-bottom: 25px;
    }
    .news-item .next {
        display: flex;
        align-items: center;
        font-size: 14px;
    }
    .news-item .next a {
        color: #051F61;
        text-decoration: none;
    }
    .news-item .next img {
        margin-right: 10px;
    }
    .news-item .news-img {
        height: 100%;
        width: 100%;
        overflow: hidden;
    }
    .news-item .news-img img {
        width: 100%;
        border-radius: 10px;
    }
    .news-item .title {
        color: #051F61;
        font-size: 20px;
        line-height: 23px;
        margin-bottom: 25px;
    }
    .news-item .description {
        color: #051F61;
        font-weight: 300;
        font-size: 12px;
        line-height: 21px;
    }
</style>
