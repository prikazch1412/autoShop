<template>
    <div>
        <div style="display:none">
            <div class="profile-modal-photo box-modal">
                <div class="box-modal_close arcticmodal-close"></div>
                <div>
                    <img class="profile_photo_i" src="">
                </div>
                <div class="modal-footer center-wrap">
                    <b-button class="js-main-image" @click="setImg">Зберегти</b-button>
                </div>
            </div>
        </div>
        <b-row class="mb-3" v-if="user.user_role_id == 3">
            <b-col cols="2" class="label-profile">
                Назва сервісу
            </b-col>
            <b-col>
                <b-form-input
                    type="text"
                    v-model="user.service_name"
                ></b-form-input>
            </b-col>
        </b-row>
        <b-row class="mb-3" v-if="user.user_role_id == 1 || user.user_role_id == 2">
            <b-col cols="2" class="label-profile">
                Ім'я
            </b-col>
            <b-col>
                <b-form-input
                    type="text"
                    v-model="user.name"
                ></b-form-input>
            </b-col>
        </b-row>
         <b-row class="mb-3" v-if="user.user_role_id == 1 || user.user_role_id == 2">
            <b-col cols="2" class="label-profile">
                Прізвище
            </b-col>
            <b-col>
                <b-form-input
                    type="text"
                    v-model="user.surname"
                ></b-form-input>
            </b-col>
        </b-row>
        <b-row class="mb-3">
            <b-col cols="2" class="label-profile">
                Email
            </b-col>
            <b-col>
                <b-form-input
                    type="text"
                    v-model="user.email"
                ></b-form-input>
            </b-col>
        </b-row>
        <b-row class="mb-3">
            <b-col cols="2" class="label-profile">
                Телефон
            </b-col>
            <b-col>
                <b-form-input
                    type="text"
                    v-model="user.phone"
                ></b-form-input>
            </b-col>
        </b-row>
        <b-row class="mb-3">
            <b-col cols="2" class="label-profile">
                Місто
            </b-col>
            <b-col>
                <b-form-select
                    v-model="user.city_id"
                    :options="city"
                    value-field="id"
                    text-field="title"
                ></b-form-select>
            </b-col>
        </b-row>
        <b-row class="mb-3">
            <b-col cols="2" class="label-profile">
                Адреса
            </b-col>
            <b-col>
                <b-form-input
                    type="text"
                    v-model="user.address"
                ></b-form-input>
            </b-col>
        </b-row>
        <b-row class="mb-3">
            <b-col cols="2" class="label-profile">
                Фото
            </b-col>
            <b-col class="photo">
                <b-img :src="user.photo" fluid class="img_size perscab-photoedit-img" id="image"></b-img>
                <input
                    type="file"
                    ref="fileinput"
                    id="fileinput"
                    class="mt-2"
                    name="photo"
                    @change="changeImg($event)"
                >
                <input
                    name="photo_c"
                    id="fileinput_c"
                    multiple="false"
                    type="hidden"
                    :value="user.photo"
                >
            </b-col>
        </b-row>
        <b-row class="mb-5" v-if="authUser.user_role_id == 2 || authUser.user_role_id == 3">
            <b-col cols="2" class="label-profile">
                Коротка інформація
            </b-col>
            <b-col>
            <b-form-textarea
                id="textarea"
                rows="3"
                max-rows="6"
                v-model="user.description"
            ></b-form-textarea>
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
import { city } from "../../../mixins/city";
export default {
    mixins: [city],
    data() {
        return {
            basic: null,
            loading: false,
            user: {
                name: "",
                surname: "",
                email: "",
                phone: "",
                address: "",
                service_name: "",
                city_id: "",
                user_role_id: "",
                photo: null,
                description: ""
            }
        }
    },
    created() {
        this.fetchCity();
        this.fetchData();
    },
    computed: {
        authUser() {
            return this.$store.getters.authUser
        }
    },
    methods: {
        fetchData() {
            axios.get('/api/profile')
            .then((response) => {
                this.user = response.data;
            })
        },
        save() {
            this.loading = true;
            this.user.photo = document.getElementById("fileinput_c").getAttribute('value')
            this.user.services = null;
            axios.post('/api/profile', this.user)
            .then((response) => {
                this.loading = false;
                this.$store.dispatch('user', response.data)
            })
            .catch((err) => {
                this.loading = false;
            })
        },
        setImg() {
            this.basic.croppie('result','base64').then(function(html) {
                axios.post('/api/img', {
                    id: JSON.parse(localStorage.getItem('user')).id,
                    photo: html,
                    photo_c: $('input[name="photo_c"]').val()
                }).then((response) => {
                    if(response.data.status == "success") {
                        console.log(response.data.path_mini)
                        $('input[name="photo_c"]').attr('value',response.data.path_mini);
                        $('.perscab-photoedit-img').attr('src',response.data.path_mini);
                        $('.profile-modal-photo').arcticmodal('close');
                    }
                });
            });
        },
        changeImg(event) {
            var formData = new FormData();
            formData.append('file', event.target.files[0]);
            formData.append('id', JSON.parse(localStorage.getItem('user')).id);

            axios.post('/api/img', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                if(response.data.status == "success") {
                    $('.profile_photo_i').attr('src',response.data.path_max);
                    this.basic = $('.profile_photo_i').croppie({
                        viewport : {
                            width : 350,
                            height : 350
                        },
                        boundary: {
                            width: 550,
                            height: 350
                        }
                    });
                    $('.profile-modal-photo').arcticmodal({
                        afterClose : function() {
                            $('.profile_photo_i').croppie('destroy');
                        }
                    });
                }
            })
        },
    }
}
</script>
<style lang="css" scoped>
    .photo img {
        width: 200px;
        display: block;
    }
</style>
