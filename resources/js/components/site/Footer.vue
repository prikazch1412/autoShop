<template>
    <div class="footer">
        <b-container>
            <b-row>
                <b-col>
                    <div class="title">
                        Загальна інформація
                    </div>
                    <ul>
                        <li>
                            <router-link to="/">Головна</router-link>
                        </li>
                        <li>
                            <router-link to="/">Про нас</router-link>
                        </li>
                    </ul>
                </b-col>
                <b-col>
                    <div class="title">
                        Аккаунт
                    </div>
                    <ul>
                        <li v-if="!isLoggedIn">
                            <router-link to="/login">Вхід</router-link>
                        </li>
                        <li v-if="!isLoggedIn">
                            <router-link to="/register">Реєстрація</router-link>
                        </li>
                        <li v-if="isLoggedIn">
                            <router-link to="/profile">Кабінет</router-link>
                        </li>
                        <li v-if="isLoggedIn">
                            <a href="#" @click="logout">Вихід</a>
                        </li>
                    </ul>
                </b-col>
                <b-col>
                    <div class="title">
                        Додаткова інформація
                    </div>
                    <ul>
                        <li>
                            Всі права захищені © 2020
                        </li>
                    </ul>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<script>
export default {
    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('logout').then(() => {
                this.$router.push('/')
            })
        },
    }
}
</script>
<style lang="css" scoped>
    .footer {
        margin-top: 50px;
        background: #ffffff;
        padding: 25px 0 35px 0;
    }
    .footer .title {
        color: #322B57;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .footer ul {
        padding: 0;
    }
    .footer ul li {
        list-style: none;
        font-weight: 300;
        font-size: 15px;
        margin-bottom: 10px;
        color: #685879;
    }
    .footer ul li a {
        color: #685879;
    }
</style>
