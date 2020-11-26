<template>
    <div>
        <b-modal v-model="orderModal" title="Замовити послугу" size="lg" hide-footer no-close-on-backdrop>
        <div class="px-3">
            <div class="title-order">
                Обрані послуги
            </div>
            <div class="select-items" v-for="(serviceItem, index) in userData.services" :key="index">
                {{ serviceItem.item.title }} {{ serviceItem.price }} грн <b-icon class="cursor" @click="delServiceItem(serviceItem)" style="float:right" icon="x" font-scale="1.5"></b-icon>
            </div>
            <hr>
            <div class="title-order">
                Ваше авто (таврия, ланос)
            </div>
            <b-row>
                <b-col>
                    <multiselect
                        :options="cars"
                        v-model="userData.car.model"
                        placeholder="Модель"
                        label="title"
                        track-by="id"
                        tagPlaceholder="Обрати"
                        selectLabel="Обрати"
                        noResult="Нічого не знайдено"
                    ></multiselect>
                </b-col>
                <b-col>
                    <multiselect
                        :options="getSeries"
                        v-model="userData.car.series"
                        placeholder="Серія"
                        label="title"
                        track-by="id"
                        tagPlaceholder="Обрати"
                        selectLabel="Обрати"
                        noResult="Нічого не знайдено"
                    ></multiselect>
                </b-col>
                <b-col>
                    <multiselect
                        :options="years"
                        v-model="userData.car.year"
                        placeholder="Рік"
                        tagPlaceholder="Обрати"
                        selectLabel="Обрати"
                        noResult="Нічого не знайдено"
                    ></multiselect>
                </b-col>
            </b-row>
            <hr>
            <div class="title-order">
                Контактна інформація
            </div>
            <b-form-input
                id="name"
                type="text"
                placeholder="Ім'я"
                v-model="userData.name"
                class="mb-3"
            ></b-form-input>

            <b-row class="mb-3">
                <b-col>
                    <b-form-input
                        type="text"
                        placeholder="Телефон"
                        v-model="userData.phone"
                    ></b-form-input>
                </b-col>
                <b-col>
                    <b-form-input
                        type="email"
                        placeholder="Email"
                        v-model="userData.email"
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-form-input
                type="text"
                placeholder="Бажаний час"
                v-model="userData.time"
                class="mb-3"
            ></b-form-input>

            <b-form-textarea
                v-model="userData.comment"
                placeholder="Ваш коментар"
                rows="3"
                max-rows="6"
                class="mb-3"
            ></b-form-textarea>

            <button @click="order">
                <span
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                    v-if="loading"
                ></span>
                <span class="sr-only" v-if="loading">Loading...</span>
                Замовити
            </button>
            </div>
        </b-modal>
        <div class="title">
            Послуги <b-button :disabled="userData.services.length == 0" type="submit" class="order-button" variant="primary" @click="orderModal = true">Замовити послугу</b-button>
        </div>
        <b-row>
            <b-col cols="4" class="service-title px-0">
                <div v-for="(item, index) in services" :key="index" :class="selectService == index ? 'active' : 'service-title-item'" @click="opesService(item, index)">
                    {{ item.service.title }}
                </div>
            </b-col>
            <b-col class="service-dewcription">
                <div
                    v-for="(serviceItem, index) in serviceItems"
                    :key="index"
                    :class="serviceItem.item.selected == 1 ? 'service-dewcription-item-active' : 'service-dewcription-item'"
                    @click="setSetrviceToOrder(serviceItem)"
                >
                    <div>{{ serviceItem.item.title }}</div><div class="filler"></div> <span v-if="serviceItem.price"><b>{{ serviceItem.price }}</b> грн</span><span v-else>Договірна</span>
                </div>
            </b-col>
        </b-row>
    </div>
</template>
<script>
import { cars } from "../../../mixins/cars";
import { series } from "../../../mixins/series";
import { years } from "../../../mixins/years";
import Multiselect from 'vue-multiselect';
export default {
    mixins: [cars, series, years],
    components: {
        Multiselect
    },
    data() {
        return {
            loading: false,
            orderModal: false,
            selectService: null,
            serviceItems: [],
            userData: {
                car: {
                    model: "",
                    series: "",
                    year: "",
                },
                time: "",
                name: "",
                phone: "",
                email: "",
                comment: "",
                services: []
            }
        }
    },
    computed: {
        getSeries() {
            if(this.userData.car.model) {
                return this.series.filter(item => {
                    return item.model_id == this.userData.car.model.id
                });
            } else {
                return this.series;
            }
        },
    },
    props: {
        services: Array,
        service_items: Array
    },
    created() {
        this.fetchCars();
        this.fetchSeries();
        if(this.$store.getters.isLoggedIn) {
            this.userData.name = this.$store.getters.authUser.name;
            this.userData.email = this.$store.getters.authUser.email;
            this.userData.phone = this.$store.getters.authUser.phone;
        }
    },
    methods: {
        order() {
            if(this.userData.car.model) {
                this.userData.car.model = this.userData.car.model.title;
            }
            if(this.userData.car.series) {
                this.userData.car.series = this.userData.car.series.title;
            }
            axios.post('/api/order/'+this.$route.params.id, this.userData)
            .then(() => {
                this.orderModal = false;
            })
        },
        opesService(item, index) {
            this.selectService = index;
            this.serviceItems = this.service_items.filter(i => {
                return i.item.service_id == item.service.id
            })
        },
        setSetrviceToOrder(itemService) {
            let index = this.userData.services.indexOf(itemService);
            if(index == -1) {
                itemService.item.selected = 1;
                this.userData.services.push(itemService);
            } else {
                itemService.item.selected = 0;
                this.userData.services.splice(index, 1);
            }
            console.log(this.userData.services)
        },
        delServiceItem(item) {
            let index = this.userData.services.indexOf(item);
            this.userData.services.splice(index, 1);
        }
    }
}
</script>
<style lang="css" scoped>
    .order-button {
        float: right;
        background: #051F61;
        border: 0;
        padding: 10px 35px;
        border-radius: 10px;
    }
    .title-order {
        font-size: 17px;
        font-family: Roboto,Helvetica,Arial,sans-serif;
        color: #272b46;
    }
    .select-items {
        padding: 10px;
        margin-bottom: 5px;
    }
    .select-items:hover {
        background: #dedede;
    }
    .title {
        color: #373B53;
        font-weight: 500;
        font-size: 30px;
        margin-bottom: 20px;
    }
    .service-dewcription-item {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: #4B515B;
    }
    .service-dewcription-item:hover {
        background: #dedede;
        cursor: pointer;
    }
    .service-dewcription-item-active {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: #4B515B;
        background: #dedede;
        cursor: pointer;
    }
    .service-title {
        border: 1px solid rgba(0, 0, 0, 0.15);
        box-sizing: border-box;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px 0px 0px 10px;
    }
    .service-dewcription {
        padding-top: 15px;
        padding-bottom: 15px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        box-sizing: border-box;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 0px 10px 10px 0px;
    }
    .service-title-item {
        padding: 15px 25px;
        color: #4B515B;
        cursor: pointer;
        font-size: 20px;
    }
    .service-title-item:hover {
        background: linear-gradient(180deg, #3095CE 0%, #5A5DD8 100%);
        color: #ffffff;
    }
    .active {
        padding: 15px 25px;
        cursor: pointer;
        font-size: 20px;
        background: linear-gradient(180deg, #3095CE 0%, #5A5DD8 100%);
        color: #ffffff;
    }
</style>
