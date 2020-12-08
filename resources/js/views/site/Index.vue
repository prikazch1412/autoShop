<template>
    <div>
        <div class="header-bg"></div>
        <b-container>
            <div class="form-search">
                <h1 class="header">Почніть пошук</h1>
                <b-row class="inputs m-0">
                    <b-col>
                        <multiselect
                            :options="servicesItems"
                            v-model="search.services"
                            placeholder="Послуга"
                            label="title"
                            track-by="id"
                            tagPlaceholder="Обрати"
                            selectLabel="Обрати"
                            noResult="Нічого не знайдено"
                        ></multiselect>
                    </b-col>
                    <b-col>
                        <multiselect
                            :options="cars"
                            v-model="search.cars"
                            placeholder="Авто"
                            label="title"
                            track-by="id"
                            selectLabel="Обрати"
                            noResult="Нічого не знайдено"
                        ></multiselect>
                    </b-col>
                    <b-col>
                        <multiselect
                            :options="city"
                            v-model="search.city"
                            placeholder="Місто"
                            label="title"
                            track-by="id"
                            selectLabel="Обрати"
                            noResult="Нічого не знайдено"
                        ></multiselect>
                    </b-col>
                </b-row>
                <button class="button" @click="searchButton">Пошук сервісу</button>
            </div>
            <div class="block-title">
                ЯК DREAMCAR МОЖЕ МЕНІ ДОПОМОГТИ?
            </div>
            <b-row>
                <b-col class="help-item">
                    <img src="/img/item-1.png">
                    <div class="title">
                        Тільки у справі
                    </div>
                    <div class="description">
                        Всі відгуки залишені клієнтами, які вже скористалися послугами.
                    </div>
                </b-col>
                <b-col class="help-item">
                    <img src="/img/item-2.png">
                    <div class="title">
                        Знаємо, що пропонуємо
                    </div>
                    <div class="description">
                        Ми стежимо за рівнем надання послуг і рекомендуємо перевірені нами компанії.
                    </div>
                </b-col>
                <b-col class="help-item">
                    <img src="/img/item-3.png">
                    <div class="title">
                        Простий онлайн-запис
                    </div>
                    <div class="description">
                        Замовляєте послугу, отримуєте SMS з підтвердженням замовлення, а також SMS-нагадування про майбутній візит.
                    </div>
                </b-col>
            </b-row>
            <div class="block-title">
                ПОПУЛЯРНІ СЕРВІСИ
            </div>
            <b-row>
                <b-col cols="4" v-for="(item, index) in popularServices" :key="index">
                    <ServiceItem :user="item"></ServiceItem>
                </b-col>
            </b-row>
            <div class="block-title">
                ОСТАННІ НОВИНИ
            </div>
            <NewsItem :data="lastNews"></NewsItem>
            <div class="block-title" v-show="!isLoggedIn">
                БІЛЬШЕ МОЖЛИВОСТЕЙ
            </div>
        </b-container>
        <div class="block-auth" v-show="!isLoggedIn">
            <b-container>
                <div class="login">
                    <div class="title">
                        Авторизація
                    </div>
                    <input v-model="credentials.email" type="text" placeholder="Email">
                    <input v-model="credentials.password" type="password" placeholder="Пароль">
                    <button @click="login">Вхід</button>
                </div>
            </b-container>
        </div>
        <hr v-show="isLoggedIn">
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect';
import ServiceItem from "../../components/site/ServiceItem";
import NewsItem from "../../components/site/NewsItem";
export default {
    components: {
        ServiceItem,
        NewsItem,
        Multiselect
    },
    data() {
        return {
            loading: false,
            search: {
                services: "",
                cars: "",
                city: ""
            },
            credentials: {
                email: "",
                password: ""
            },
            servicesItems: [],
            cars: [],
            city: [],
            popularServices: [],
            lastNews: []
        }
    },
    created() {
        this.getData();
    },
    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn
        }
    },
    methods: {
        getData() {
            axios.get('/api/home')
            .then((response) => {
                this.popularServices = response.data.popularServices;
                this.lastNews = response.data.lastNews;
                this.servicesItems = response.data.servicesItems;
                this.cars = response.data.cars;
                this.city = response.data.city;
            })
        },
        searchButton() {
            if(this.search.services) {
                this.search.services = this.search.services.id;
            }
            if(this.search.cars) {
                this.search.cars = this.search.cars.id;
            }
            if(this.search.city) {
                this.search.city = this.search.city.id;
            }
            this.$router.push({ name: 'services', query: this.search})
        },

        login() {
            this.loading = true;
            this.$store.dispatch('login', this.credentials)
            .then(() => {
                window.location.href = '/profile';
            })
            .catch(err => {
                this.loading = false;
            })
        },
    }
}
</script>
<style lang="css" scoped>
    .form-search {
        padding-top: 40px;
        min-height: 200px;
        width: 80%;
        background: #ffffff;
        margin: 0 auto;
        border-radius: 10px;
        margin-top: -100px;
    }
    .form-search .header {
        text-align: center;
        color: #555555;
        font-size: 24px;
        margin-bottom: 20px;
    }
    .form-search .button {
        width: 100%;
        color: #ffffff;
        font-weight: bold;
        background: #051F61;
        border: 0;
        padding: 20px 0;
        margin-top: 40px;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .form-search .inputs input {
        border-radius: 5px;
        background: #ffffff;
        width: 100%;
        padding: 10px;
        border: 0;
        box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
        outline: none;
    }
    .block-auth .login .title {
        text-align: center;
        font-size: 28px;
        color: #051F61;
        font-weight: normal;
        margin-bottom: 20px;
    }
    .block-auth .login input {
        background: #ffffff;
        border: 1px solid rgb(175, 175, 175);
        border-radius: 10px;
        display: block;
        outline: none;
        margin-bottom: 15px;
        padding: 10px;
        font-size: 16px;
        width: 100%;
    }
    .block-auth .login button {
        background: #051F61;
        color: #ffffff;
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        border: 0;
        border-radius: 10px;
    }
    .block-auth .login {
        background: #ffffff;
        padding: 35px;
        float: right;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        width: 350px;
    }
    .block-auth {
        height: 330px;
        background: url("/img/auth_bg.jpg") no-repeat;
        background-size: cover;
        display: flex;
        align-items: center;
    }
    .help-item {
        text-align: center;
        padding: 0 50px;
    }
    .help-item .title {
        color: #051F61;
        font-weight: normal;
        font-size: 20px;
        line-height: 23px;
        padding: 30px 0;
    }
    .help-item .description {
        color: #374754;
        font-weight: 300;
        font-size: 13px;
        line-height: 20px;
    }
    .block-title {
        text-align: center;
        font-size: 31px;
        line-height: 37px;
        color: #051F61;
        font-weight: normal;
        margin: 50px 0;
    }
    .header-bg {
        height: 673px;
        background: url('/img/home_bg.png') no-repeat;
        background-size: cover;
    }
</style>
