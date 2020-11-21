<template>
    <div class="service-item">
        <div class="service-img">
            <img src="/img/news.png" alt="">
        </div>
        <div class="title">Lorem ipsum dolor</div>
        <div class="description">Lorem ipsum dolor sit amet adipiscing </div>
        <b-row class="info-item">
            <b-col class="title" cols="4">Title</b-col>
            <b-col cols="8">Snfo</b-col>
        </b-row>
        <b-row class="info-item">
            <b-col class="title" cols="4">Title</b-col>
            <b-col cols="8">Snfo</b-col>
        </b-row>
        <b-row class="info-item">
            <b-col class="title" cols="4">Title</b-col>
            <b-col cols="8">Snfo</b-col>
        </b-row>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="css" scoped>
    .service-item .service-img {
        height: 155px;
        overflow: hidden;
    }
    .service-item .service-img img {
        width: 100%;
    }
    .service-item .description {
        color: #A6ACBE;
        font-weight: 500;
        font-size: 14px;
        text-align: center;
        margin-bottom: 10px;
    }
    .service-item .title {
        color: #373B53;
        font-weight: 500;
        font-size: 30px;
        text-align: center;
    }
    .service-item .info-item {
        color: #A6ACBE;
        font-weight: 500;
        font-size: 14px;
        line-height: 21px;
        margin-bottom: 10px;
    }
    .service-item .info-item .title {
        color: #4B515B;
        font-weight: 500;
        font-size: 14px;
    }
    .service-item {
        padding: 0 0 15px 0;
        border-radius: 10px;
        box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
    }
</style>
