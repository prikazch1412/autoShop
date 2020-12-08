<template>
    <v-app-bar app color="white" flat>
        <v-container class="py-0 fill-height">
            <b>Адміністративна панель</b>
            <v-spacer></v-spacer>
            <v-btn icon to="/" target="_blank">
                <v-icon class="material-icons">language</v-icon>
            </v-btn>
            <v-btn icon @click="logout">
                <v-icon class="material-icons">exit_to_app</v-icon>
            </v-btn>
        </v-container>
    </v-app-bar>
</template>

<script>
export default {
    data: () => ({}),
    methods: {
        logout() {
            this.$store.dispatch('logout').then(() => {
                window.location.href = '/admin';
            })
        }
    },
}
</script>
