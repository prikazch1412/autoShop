<template>
    <b-container class="wrapper-page">
        <div class="form-search">
            <b-row class="inputs m-0">
                <b-col class="pl-0">
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
                <b-col>
                    <input type="text" placeholder="Назва сервісу" v-model="search.title">
                </b-col>
                <b-col class="pr-0">
                    <button class="button" @click="searchButton">
                        <span
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"
                            v-if="loading"
                        ></span>
                        <span class="sr-only" v-if="loading">Loading...</span>
                        Пошук
                    </button>
                </b-col>
            </b-row>
            <b-row class="inputs ml-0 mr-0 mt-4">
                    <b-col class="pl-0">
                        <b-form-group>
                            <b-form-checkbox-group
                                id="checkbox-service"
                                name="checkbox-service"
                                v-model="search.user_roles"
                                :options="user_types"
                            >
                            </b-form-checkbox-group>
                        </b-form-group>
                    </b-col>
            </b-row>
        </div>
        <div class="d-flex justify-content-center" v-if="preloader">
            <b-spinner style="width: 4rem; height: 4rem;" label="Large Spinner"></b-spinner>
        </div>
        <div v-if="!preloader && users.length == 0" class="text-center">
            Нічого не знайдено
        </div>
        <b-row>
            <b-col cols="4" v-for="(item, index) in users" :key="index">
                <ServiceItem :user="item"></ServiceItem>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
import { services } from "../../mixins/services";
import { cars } from "../../mixins/cars";
import { city } from "../../mixins/city";

import Multiselect from 'vue-multiselect';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import ServiceItem from "../../components/site/ServiceItem";
export default {
    mixins: [services, cars, city],
    components: {
        ServiceItem,
        DatePicker,
        Multiselect
    },
    data() {
        return {
            preloader: true,
            moreFilter: false,
            loading: false,
            users: [],
            services: [],
            user_types: [
                { text: 'Сервісний центр', value: '3' },
                { text: 'Майстер', value: '2' }
            ],
            search: {
                services: "",
                cars: "",
                city: "",
                title: "",
                user_roles: []
            }
        }
    },
    created() {
        this.fetchServicesItems();
        this.fetchCars();
        this.fetchCity();
        this.fetchData();
    },
    methods: {
        searchButton() {
            this.loading = true;
            var searchData = Object.assign({}, this.search);
            if(this.search.services) {
                searchData.services = this.search.services.id;
            }
            if(this.search.cars) {
                searchData.cars = this.search.cars.id;
            }
            if(this.search.city) {
                searchData.city = this.search.city.id;
            }
            axios.get('/api/service', {
                params: searchData
            })
            .then((response) => {
                this.users = response.data;
                this.loading = false;
            })
        },
        fetchData() {
            if (Object.keys(this.$route.query).length != 0) {
                axios.get('/api/service', {
                    params: this.$route.query
                 })
                .then((response) => {
                    this.preloader = false;
                    this.users = response.data;
                }).catch(() => {
                    this.preloader = false;
                });
            } else {
                axios.get('/api/service', {
                    params: this.search
                })
                .then((response) => {
                    this.preloader = false;
                    this.users = response.data;
                }).catch(() => {
                    this.preloader = false;
                });
            }
        }
    }
}
</script>
<style lang="css" scoped>
    .more-filter {
        text-align: center;
        padding: 10px 0;
    }
    .form-search {
        margin: 40px 0;
    }
    .form-search .button {
        width: 100%;
        color: #ffffff;
        font-weight: bold;
        background: #051F61;
        border: 0;
        padding: 10px 0;
        border-radius: 10px;
    }
    .form-search .inputs {
        display: flex;
        align-items: center;
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
</style>
