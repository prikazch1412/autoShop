<template>
    <b-container class="wrapper">
        <b-row>
            <b-col cols="9" class="info mr-3">
                <b-row>
                    <b-col cols="4">
                        <img class="avatar" src="/img/avatar.png" alt="">
                    </b-col>
                    <b-col>
                        <div class="title">Lorem ipsum dolor</div>
                        <b-row class="description">
                            <b-col cols="3" class="description-item">Lorem ipsum:</b-col>
                            <b-col>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet</b-col>
                        </b-row>
                        <b-row class="description">
                            <b-col cols="3" class="description-item">Lorem ipsum:</b-col>
                            <b-col>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet</b-col>
                        </b-row>
                        <b-row class="description">
                            <b-col cols="3" class="description-item">Lorem ipsum:</b-col>
                            <b-col>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do Lorem ipsum dolor sit amet</b-col>
                        </b-row>
                    </b-col>
                </b-row>
            </b-col>
            <b-col class="menu pt-3 pb-0 pl-0 pr-0">
                <ul>
                    <li><router-link :to="'/service/' + $route.params.id">Послуги</router-link></li>
                    <li><router-link :to="'/service/' + $route.params.id + '/photo'">Фото</router-link></li>
                    <li><router-link :to="'/service/' + $route.params.id + '/reviews'">Відгуки</router-link></li>
                    <li><router-link :to="'/service/' + $route.params.id + '/address'">Адреса</router-link></li>
                    <li><router-link to="/">Задати питання</router-link></li>
                </ul>
                <button class="order-button">Замовити послугу</button>
            </b-col>
        </b-row>
        <div class="pages">
            <Services v-if="$route.name == 'service-view'"></Services>
            <Reviews v-if="$route.name == 'service-view-reviews'"></Reviews>
            <Address v-if="$route.name == 'service-view-address'"></Address>
            <Photo v-if="$route.name == 'service-view-photo'"></Photo>
        </div>
    </b-container>
</template>
<script>
import Services from "../../components/site/service/Services";
import Reviews from "../../components/site/service/Reviews";
import Photo from "../../components/site/service/Photo";
import Address from "../../components/site/service/Address";
export default {
    components: {
        Services,
        Reviews,
        Photo,
        Address
    }
}
</script>
<style lang="css" scoped>
    .pages {
        margin-top: 20px;
        padding: 20px 50px 20px 50px;
        margin-right: -15px;
        margin-left: -15px;
    }
    .menu .order-button {
        border: 0;
        background: #051F61;
        border-radius: 10px;
        font-weight: 500;
        font-size: 18px;
        color: #FFFFFF;
        width: 100%;
        padding: 10px 0;
        position: absolute;
        bottom: 0;
    }
    .menu ul li a:hover {
        color: #3174D2;
        text-decoration: none;
    }
    .menu ul li a {
        color: #373B53;
    }
    .menu ul li {
        list-style: none;
        text-align: center;
        padding: 10px 0;
    }
    .menu ul {
        padding: 0;
        margin: 0;
    }
    .wrapper {
        margin-top: 40px;
    }
    .info {
        padding: 40px 60px;
    }
    .info img {
        width: 100%;
        margin: 0 auto;
    }
    .info .title {
        color: #373B53;
        font-weight: 500;
        font-size: 30px;
        line-height: 44px;
        margin-bottom: 30px;
    }
    .info .description {
        color: #A6ACBE;
        font-weight: 500;
        font-size: 14px;
        line-height: 21px;
    }
    .info .description .description-item {
        color: #4B515B;
    }
    .info, .menu, .pages {
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
    }
</style>
