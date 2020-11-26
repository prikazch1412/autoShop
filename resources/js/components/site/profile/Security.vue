<template>
    <div>
        <b-row class="mb-3">
            <b-col cols="3" class="label-profile">
                Стврий пароль
            </b-col>
            <b-col>
                <b-form-input
                    type="password"
                    v-model="user.oldPassword"
                ></b-form-input>
            </b-col>
        </b-row>
        <b-row class="mb-3">
            <b-col cols="3" class="label-profile">
                Новий пароль
            </b-col>
            <b-col>
                <b-form-input
                    type="password"
                    v-model="user.newPassword"
                ></b-form-input>
            </b-col>
        </b-row>
         <b-row class="mb-3">
            <b-col cols="3" class="label-profile">
                Повторіть пароль
            </b-col>
            <b-col>
                <b-form-input
                    type="password"
                    v-model="user.repeatPassword"
                ></b-form-input>
            </b-col>
        </b-row>
        <div class="buttons-profile">
            <b-button type="submit" variant="primary" @click="save">
                <span
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                    v-if="loading"
                ></span>
                <span class="sr-only" v-if="loading">Loading...</span>
                Зберегти
            </b-button>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading: false,
            user: {
                newPassword: "",
                oldPassword: "",
                repeatPassword: ""
            }
        }
    },
    methods: {
        save() {
            this.loading = true;
            axios.post('/api/profile', this.user)
            .then((response) => {
                this.loading = false;
            })
            .catch((err) => {
                this.loading = false;
            })
        },
    }
}
</script>
<style lang="css" scoped>

</style>
