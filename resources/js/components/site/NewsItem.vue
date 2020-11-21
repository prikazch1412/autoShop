<template>
    <div>
        <b-row v-for="i in 3" :key="i" class="news-item">
            <b-col cols="4">
                <div class="news-img">
                    <img src="/img/news.png" alt="">
                </div>
            </b-col>
            <b-col cols="6">
                <div class='title'>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </div>
                <div class="descriprion">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, atque. Fuga, nam! Suscipit assumenda molestias perspiciatis aperiam praesentium. Accusamus nobis cumque tenetur culpa eligendi voluptatum temporibus earum animi consequatur amet.
                </div>
            </b-col>
            <b-col cols="2" class="next">
                <div>
                    <img src="/img/next.png" alt=""> Далі
                </div>
            </b-col>
        </b-row>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="css" scoped>
    .news-item {
        margin-bottom: 25px;
    }
    .news-item .next {
        display: flex;
        align-items: center;
        color: #051F61;
        font-size: 14px;
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
