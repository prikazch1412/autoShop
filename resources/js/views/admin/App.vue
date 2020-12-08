<template>
    <div>
        <div v-if="isAdmin">
            <navigation></navigation>
            <v-main class="grey lighten-3">
                <v-container>
                    <v-row>
                        <v-col cols="3">
                            <v-sheet rounded="lg">
                                <v-list color="transparent">
                                    <v-list-item
                                        v-for="(item, index) in link"
                                        :key="index"
                                        link
                                        exact
                                        :to="'/admin/'+item.link"
                                    >
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            {{ item.title }}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-sheet>
                        </v-col>
                        <v-col cols="9">
                            <v-sheet min-height="70vh" rounded="lg" class="pa-5">
                                <router-view></router-view>
                            </v-sheet>
                        </v-col>
                    </v-row>
                </v-container>
            </v-main>
        </div>
        <div v-else>
            <login></login>
        </div>
    </div>
</template>
<script>
import navigation from '../../components/admin/Navigation';
import login from './Login';
export default {
    data() {
        return {
            link: [
                {
                    link: "",
                    title: "Користувачі"
                },
                {
                    link: "services",
                    title: "Сервіси"
                },
                {
                    link: "orders",
                    title: "Замовлення"
                },
                {
                    link: "news",
                    title: "Новини авто"
                }
            ]
        }
    },
    components: {
        navigation,
        login
    },
    computed: {
        isAdmin() {
            return this.$store.getters.isLoggedInAdmin
        }
    },
}
</script>
