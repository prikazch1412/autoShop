<template>
    <b-container class="header" fluid>
        <img class="logo" src="/img/logo.png">
        <span class="title">CarDream</span>
        <div class="filler"></div>
        <ul>
            <li><router-link to="/">Головна</router-link></li>
            <li><router-link to="/services">Сервіси</router-link></li>
            <li><router-link to="/news">Новини</router-link></li>
            <li><router-link to="/profile">Кабінет</router-link></li>
            <li><span @click="loginForm = true">Вхід</span> / <span @click="registerForm = true">Реєстрація</span></li>
            <li><b-icon icon="box-arrow-right" variant="white" font-scale="1.5" aria-hidden="true"></b-icon></li>
        </ul>
        <b-modal v-model="loginForm" title="Авторизація" hide-footer>
            <b-form-group
                id="email"
                label="Email"
                label-for="email"
            >
                <b-form-input
                    id="email"
                    type="email"
                    placeholder="Email"
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
                ></b-form-input>
            </b-form-group>

            <button>Вхід</button>
        </b-modal>

        <b-modal v-model="registerForm" title="Реєстрація" hide-footer>
            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="email">Email</label>
                </b-col>
                <b-col>
                <b-form-input
                    id="email"
                    type="email"
                    placeholder="Email"
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
                ></b-form-input>
                </b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="sity">Місто</label>
                </b-col>
                <b-col>
                    <b-form-select></b-form-select>
                </b-col>
            </b-row>

            <b-row class="user-types mx-0 mb-3">
                <b-col class="user-type" style="border-radius: 10px 0 0 10px">Автовласник</b-col>
                <b-col class="user-type">Майстер</b-col>
                <b-col class="user-type" style="border-radius: 0 10px 10px 0">Сервісний центр</b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="name">І'мя</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="name"
                        type="text"
                        placeholder="І'мя"
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="surname">Прізвище</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="surname"
                        type="text"
                        placeholder="Прізвище"
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
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-row class="mb-3">
                <b-col cols="3" class="label-form">
                    <label for="repeat-password">Повторіть пароль</label>
                </b-col>
                <b-col>
                    <b-form-input
                        id="repeat-password"
                        type="password"
                        placeholder="Пароль"
                    ></b-form-input>
                </b-col>
            </b-row>

            <button>Реєстрація</button>
        </b-modal>

    </b-container>
</template>
<script>
export default {
    data() {
        return {
            loginForm: false,
            registerForm: true
        }
    },
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
</style>
