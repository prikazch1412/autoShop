<template>
<v-container fluid class="my-8">
      <v-layout wrap>
        <v-flex sm12 md6 offset-md3>
          <v-card elevation="4" light tag="section">
            <v-card-title>
              <v-layout align-center justify-space-between>
                <h3 class="headline">Авторизація</h3>
              </v-layout>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <p>Увійдіть за допомогою електронної пошти та пароля:</p>
              <v-form>
                <v-text-field
                    outline
                    label="Email"
                    type="text"
                    v-model="credentials.email"
                ></v-text-field>
                <v-text-field
                    outline
                    hide-details
                    label="Пароль"
                    type="password"
                    v-model="credentials.password"
                ></v-text-field>
              </v-form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions :class="{ 'pa-3': $vuetify.breakpoint.smAndUp }">
              <v-spacer></v-spacer>
              <v-btn color="info" :large="$vuetify.breakpoint.smAndUp" :loading="loading" @click="login">
                <v-icon left>lock</v-icon>
                Вхід
              </v-btn>
            </v-card-actions>
            <v-card-text class="pt-0">
                <v-alert v-if="error" :value="true" type="error">Помилка</v-alert>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
</template>
<script>
export default {
    data(){
        return {
            credentials: {
                email: "",
                password: ""
            },
            error: false,
            loading: false
        }
    },
    methods: {
        login() {
            this.loading = true;
            this.$store.dispatch('loginAdmin', this.credentials)
            .then(() => {
                this.error = false;
                this.loading = false;
            })
            .catch(err => {
                this.error = true;
                this.loading = false;
            })
        }
    }
}
</script>
<style lang="css" scoped>
    .v-btn, .v-card {
        border-radius: 4px
    }
    .v-card__title {
        text-transform: uppercase
    }
</style>
