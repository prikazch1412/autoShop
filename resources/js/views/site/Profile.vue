<template>
    <b-container class="wrapper">
        <b-row>
            <b-col cols="3">
                <ul class="menu">
                    <li><router-link :class="$route.name == 'profile' ? 'active' : ''" to="/profile">Загальна інформація</router-link></li>
                    <li><router-link :class="$route.name == 'profile-security' ? 'active' : ''" to="/profile/security">Налаштування безпеки</router-link></li>
                    <li><router-link :class="$route.name == 'profile-services' ? 'active' : ''" to="/profile/services">Послуги</router-link></li>
                    <li><router-link :class="$route.name == 'profile-photo' ? 'active' : ''" to="/profile/photo">Фото</router-link></li>
                    <li><router-link :class="$route.name == 'profile-reviews' ? 'active' : ''" to="/profile/reviews">Відгуки</router-link></li>
                    <li><router-link :class="$route.name == 'profile-orders' ? 'active' : ''" to="/profile/orders">Заявки</router-link></li>
                    <li><router-link :class="$route.name == 'profile-chats' ? 'active' : ''" to="/profile/chats">Діалоги</router-link></li>
                    <li><router-link :class="$route.name == 'profile-cars' ? 'active' : ''" to="/profile/cars">Мої авто</router-link></li>
                </ul>
            </b-col>
            <b-col class="pages">
                <Index v-if="$route.name == 'profile'"></Index>
                <Security v-if="$route.name == 'profile-security'"></Security>
                <Services v-if="$route.name == 'profile-services'"></Services>
                <Photo v-if="$route.name == 'profile-photo'"></Photo>
                <Reviews v-if="$route.name == 'profile-reviews'"></Reviews>
                <Orders v-if="$route.name == 'profile-orders'"></Orders>
                <Chats v-if="$route.name == 'profile-chats'"></Chats>
                <Cars v-if="$route.name == 'profile-cars'"></Cars>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
import Index from "../../components/site/profile/Index";
import Security from "../../components/site/profile/Security";
import Services from "../../components/site/profile/Services";
import Photo from "../../components/site/profile/Photo";
import Reviews from "../../components/site/profile/Reviews";
import Orders from "../../components/site/profile/Orders";
import Cars from "../../components/site/profile/Cars";
import Chats from "../../components/site/profile/Chats";
export default {
    components: {
        Index,
        Security,
        Services,
        Photo,
        Reviews,
        Orders,
        Cars,
        Chats
    }
}
</script>
<style lang="css" scoped>
    .pages {
        padding: 30px;
    }
    .wrapper {
        margin-top: 40px;
    }
    .pages, ul.menu {
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
    }
    ul.menu {
        padding: 0;
        margin: 0;
    }
    ul.menu li {
        list-style: none;
    }
    ul.menu li a {
        padding: 15px;
        color: #4B515B;
        display: block;
    }
    ul.menu a:hover {
        text-decoration: none;
        background: linear-gradient(180deg, #3095CE 0%, #5A5DD8 100%);
        color: #ffffff;
    }
    a.active {
        text-decoration: none;
        background: linear-gradient(180deg, #3095CE 0%, #5A5DD8 100%);
        color: #ffffff !important;
    }
</style>
