<template>
    <div class="service-item">
        <div class="service-img">
            <img v-if="user.photos.length == 0" :src="user.photo" alt="">
            <b-carousel
                v-else
                id="carousel-fade"
                style="text-shadow: 0px 0px 2px #000"
                fade
                indicators
            >
                <b-carousel-slide
                    v-for="(item, index) in user.photos"
                    :key="index"
                    caption=""
                    :img-src="item.src"
                ></b-carousel-slide>
            </b-carousel>
        </div>
        <div class="title">
            <router-link :to="'/service/'+user.id">
                <span v-if="user.user_role_id == 2">{{ user.name }} {{ user.surname }}</span>
                <span v-if="user.user_role_id == 3">{{ user.service_name }}</span>
            </router-link>
        </div>
        <div class="description">{{ user.description }}</div>
        <b-row class="info-item">
            <b-col class="title" cols="4">Адреса:</b-col>
            <b-col cols="8">{{ user.address }}</b-col>
        </b-row>
        <b-row class="info-item">
            <b-col class="title" cols="4">Телефон:</b-col>
            <b-col cols="8">{{ user.phone }}</b-col>
        </b-row>
        <b-row class="info-item">
            <b-col class="title" cols="4">Послуги:</b-col>
            <b-col cols="8"><span v-for="(item, index) in user.services" :key="index">{{ item.service.title }} </span></b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    props: {
        user: Object
    }
}
</script>
<style lang="css" scoped>
    .service-item .service-img {
        height: 230px;
        border-radius: 10px 10px 0 0;
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
        margin-bottom: 15px;
    }
    .service-item .title {
        color: #373B53;
        font-weight: 500;
        font-size: 30px;
        text-align: center;
        margin-bottom: 0;
    }
    .service-item .title a {
        color: #373B53;
    }
    .service-item .title a:hover {
        text-decoration: none;
    }
    .service-item .info-item {
        color: #A6ACBE;
        font-weight: 500;
        font-size: 14px;
        line-height: 21px;
        margin-bottom: 15px;
    }
    .service-item .info-item .title {
        color: #4B515B;
        font-weight: 500;
        font-size: 14px;
    }
    .service-item {
        padding: 0 0 5px 0;
        border-radius: 10px;
        box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
    }
</style>
