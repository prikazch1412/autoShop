<template>
    <b-container class="header" fluid>
        <img class="logo" src="/img/logo.png">
        <span class="title">CarDream</span>
        <div class="filler"></div>
        <ul>
            <li><router-link to="/">Головна</router-link></li>
            <li><router-link to="/services">Сервіси</router-link></li>
            <li><router-link to="/news">Новини</router-link></li>
            <li class="cursor" v-if="isLoggedIn"><router-link to="/favorites">Обрані сервіси</router-link></li>
            <li class="cursor" v-if="isLoggedIn"><router-link to="/profile">Кабінет</router-link></li>
            <li class="cursor" v-if="!isLoggedIn">
                <span @click="loginForm = true">Вхід</span> / <span @click="registerForm = true">Реєстрація</span>
            </li>
            <li class="cursor" v-if="isLoggedIn">
                <b-icon
                    icon="box-arrow-right"
                    variant="white"
                    font-scale="1.5"
                    aria-hidden="true"
                    @click="logout"
                ></b-icon>
            </li>
        </ul>

        <!-- login -->

        <b-modal v-model="loginForm" title="Авторизація" hide-footer no-close-on-backdrop>
            <b-form-group
                id="email"
                label="Email"
                label-for="email"
            >
                <b-form-input
                    id="email"
                    type="email"
                    placeholder="Email"
                    v-model="loginCredentials.email"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="password"
                label="Пароль"
                label-for="password"
            >
                <b-form-input
                    id="password"
                    type="password"
                    placeholder="Пароль"
                    v-model="loginCredentials.password"
                ></b-form-input>
            </b-form-group>

            <button @click="login">
                <span
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                    v-if="loading"
                ></span>
                <span class="sr-only" v-if="loading">Loading...</span>
                Вхід
            </button>
        </b-modal>

        <!-- регистрация -->

        <b-modal v-model="registerForm" title="Реєстрація" hide-footer no-close-on-backdrop>
            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="email">Email</label>
                </b-col>
                <b-col>
                <b-form-input
                    id="email"
                    type="email"
                    placeholder="Email"
                    v-model="registerCredentials.email"
                    name="email"
                    v-validate="'required|email'"
                    :class="errors.has('email') ? 'input-has-error' : ''"
                ></b-form-input>
                </b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="phone">Телефон</label>
                </b-col>
                <b-col>
                <b-form-input
                    id="phone"
                    type="text"
                    placeholder="Телефон"
                    v-model="registerCredentials.phone"
                    name="phone"
                    v-validate="'required'"
                    :class="errors.has('phone') ? 'input-has-error' : ''"
                ></b-form-input>
                </b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="city">Місто</label>
                </b-col>
                <b-col>
                    <multiselect
                        :options="city"
                        v-model="registerCredentials.city"
                        placeholder="Місто"
                        label="title"
                        track-by="id"
                        tagPlaceholder="Обрати"
                        selectLabel="Обрати"
                        noResult="Нічого не знайдено"
                        name="city"
                        v-validate="'required'"
                        :class="errors.has('city') ? 'input-has-error' : ''"
                    ></multiselect>
                </b-col>
            </b-row>

            <b-row class="user-types mx-0 mb-3">
                <b-col
                    @click="changeType(1)"
                    style="border-radius: 10px 0 0 10px"
                    :class="registerCredentials.user_role_id == 1 ? 'user-type active' : 'user-type'"
                >Автовласник</b-col>
                <b-col
                    @click="changeType(2)"
                    :class="registerCredentials.user_role_id == 2 ? 'user-type active' : 'user-type'"
                >Майстер</b-col>
                <b-col
                    @click="changeType(3)"
                    style="border-radius: 0 10px 10px 0"
                    :class="registerCredentials.user_role_id == 3 ? 'user-type active' : 'user-type'"
                >Сервісний центр</b-col>
            </b-row>

            <b-row v-if="registerCredentials.user_role_id == 3" class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="service_name">Назва сервісу</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="service_name"
                        type="text"
                        placeholder="І'мя"
                        v-model="registerCredentials.service_name"
                        name="service_name"
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-row v-if="registerCredentials.user_role_id == 1 || registerCredentials.user_role_id == 2" class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="name">І'мя</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="name"
                        type="text"
                        placeholder="І'мя"
                        v-model="registerCredentials.name"
                        name="name"
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-row v-if="registerCredentials.user_role_id == 1 || registerCredentials.user_role_id == 2" class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="surname">Прізвище</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="surname"
                        type="text"
                        placeholder="Прізвище"
                        v-model="registerCredentials.surname"
                        name="surname"
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="password">Пароль</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="password"
                        type="password"
                        placeholder="Пароль"
                        v-model="registerCredentials.password"
                        name="password"
                        v-validate="'required'"
                        :class="errors.has('password') ? 'input-has-error' : ''"
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="repeat_password">Повторіть пароль</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="repeat_password"
                        type="password"
                        placeholder="Пароль"
                        name="repeat_password"
                        v-validate="'required'"
                        v-model="registerCredentials.repeat_password"
                        :class="errors.has('repeat_password') ? 'input-has-error' : ''"
                    ></b-form-input>
                </b-col>
            </b-row>
                <b-alert :show="error" variant="danger">
                    Помилка
                </b-alert>

                <b-form-checkbox
                    v-model="agreement"
                    value-field="true"
                    disabled-field="false"
                    style="text-align: justify;margin-bottom: 20px"
                    name="agreement"
                    v-validate="'required:true'"
                    :class="errors.has('agreement') ? 'input-has-error-2' : ''"
                >Заповнюючи форму, Ви тим самим даєте згоду на обробку своїх особистих персональних даних відповідно до Закону України «Про захист персональних даних» від 01.06.2010 р. № 2297-VІ та в рамках подальшої співпраці</b-form-checkbox>

            <button @click="register">
                <span
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                    v-if="loading"
                ></span>
                <span class="sr-only" v-if="loading">Loading...</span>
                Реєстрація
            </button>
        </b-modal>

    </b-container>
</template>
<script>
import { city } from "../../mixins/city";
import Multiselect from 'vue-multiselect';
export default {
    mixins: [city],
    components: {
        Multiselect
    },
    data() {
        return {
            agreement: false,
            loginForm: false,
            registerForm: false,
            loading: false,
            error: false,
            loginCredentials: {
                email: "",
                password: ""
            },
            registerCredentials: {
                email: "",
                phone: "",
                service_name: "",
                name: "",
                surname: "",
                password: "",
                repeat_password: "",
                city: null,
                user_role_id: 1
            }
        }
    },
    created() {
        this.fetchCity();
    },
    computed: {
        avatar() {
            return this.$store.getters.authUser ? this.$store.getters.authUser.photo : "/img/no-image.png"
        },
        isLoggedIn() {
            return this.$store.getters.isLoggedIn
        }
    },
    methods: {
        changeType(typeId) {
            this.registerCredentials.name = "";
            this.registerCredentials.surname = "";
            this.registerCredentials.service_name = "";
            this.registerCredentials.user_role_id = typeId;
        },
        login() {
            this.$validator.validateAll().then((result) => {
                if (!result) {
                    return;
                } else {
                    this.loading = true;
                    this.$store.dispatch('login', this.loginCredentials)
                    .then(() => {
                        this.error = false;
                        window.location.href = '/profile';
                    })
                    .catch(err => {
                        this.loading = false;
                        this.error = true;
                    })
                }
            })
        },
        register() {
            this.$validator.validateAll().then((result) => {
                if (!result) {
                    return;
                } else {
                    this.registerCredentials.city_id = this.registerCredentials.city.id
                    this.loading = true
                    this.$store.dispatch('register', this.registerCredentials)
                    .then(() => {
                        this.error = false
                        window.location.href = '/profile';
                    }).catch(err => {
                        this.error = true
                        this.loading = false
                    })
                }
            })
        },
        logout() {
            this.$store.dispatch('logout').then(() => {
                this.$router.push('/')
            })
        },
    }
}
</script>
<style lang="css" scoped>
    .label-form {
        display: flex;
        align-items: center;
    }
    .user-type:hover {
        background: #284daa;
    }
    .user-type {
        cursor: pointer;
        padding: 10px 0;
        text-align: center;
        background: #051F61;
        color: #ffffff;
    }
    button {
        background: #051F61;
        color: #ffffff;
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        border: 0;
        border-radius: 10px;
    }
    .header {
        padding: 0 50px;
        display: flex;
        align-items: center;
        height: 60px;
        background: #1F2326;
    }
    .header .title {
        color: #ffffff;
        font-size: 18px;
        margin-left: 10px;
        font-weight: 400;
        margin-bottom: 0;
    }
    .header ul {
        margin: 0;
    }
    .header ul li {
        font-weight: 500;
        color: #ffffff;
        float: left;
        list-style: none;
        margin-right: 40px;
    }
    .header ul li a {
        font-weight: 500;
        color: #ffffff;
        font-size: 14px;
        letter-spacing: 0.01em;
    }
    .header ul li a:hover {
        text-decoration: none;
    }
    .active {
        background: #284daa;
    }
</style>
