<template>
    <div>
        <b-modal v-model="carModal" title="Додати авто" hide-footer no-close-on-backdrop>
            <b-form-group
                label="Модель"
                label-for="model"
            >
                <multiselect
                    :options="cars"
                    v-model="newCar.model"
                    placeholder="Модель"
                    label="title"
                    track-by="id"
                    tagPlaceholder="Обрати"
                    selectLabel="Обрати"
                    noResult="Нічого не знайдено"
                ></multiselect>
            </b-form-group>

            <b-form-group
                label="Сeрія"
                label-for="series"
            >
                <multiselect
                    :options="getSeries"
                    v-model="newCar.series"
                    placeholder="Серія"
                    label="title"
                    track-by="id"
                    tagPlaceholder="Обрати"
                    selectLabel="Обрати"
                    noResult="Нічого не знайдено"
                ></multiselect>
            </b-form-group>

            <b-form-group
                label="Рік"
                label-for="year"
            >
                <multiselect
                    :options="years"
                    v-model="newCar.year"
                    placeholder="Рік"
                    tagPlaceholder="Обрати"
                    selectLabel="Обрати"
                    noResult="Нічого не знайдено"
                ></multiselect>
            </b-form-group>

            <button @click="addCar">Додати</button>
        </b-modal>

        <b-row class="mb-3">
            <b-col>
                Марка
            </b-col>
            <b-col>
                Серия
            </b-col>
            <b-col>
                Год
            </b-col>
            <b-col></b-col>
        </b-row>
        <b-row v-for="(item, index) in user.cars" :key="index" class="table">
            <b-col>
                ZAZ
            </b-col>
            <b-col>
                TAVRIA
            </b-col>
            <b-col>
                1998
            </b-col>
            <b-col class="text-right">
                <b-icon @click="delCar(item)" class="cursor" icon="x" font-scale="1.5"></b-icon>
            </b-col>
        </b-row>
        <div class="mb-5"></div>
        <div class="buttons-profile">
            <b-button type="submit" @click="carModal = true" variant="primary">Додати +</b-button>
        </div>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect';
import { series } from "../../../mixins/series";
import { cars } from "../../../mixins/cars";
import { years } from "../../../mixins/years";
export default {
    mixins: [series, cars, years],
    components: {
        Multiselect
    },
    data() {
        return {
            carModal: false,
            user: {
                cars: []
            },
            newCar: {
                model: "",
                series: "",
                year: ""
            }
        }
    },
    created() {
        this.fetchCars();
        this.fetchSeries();
        this.fetchData();
    },
    computed: {
        getSeries() {
            if(this.newCar.model) {
                return this.series.filter(item => {
                    return item.model_id == this.newCar.model.id
                });
            } else {
                return this.series;
            }
        },
    },
    methods: {
        fetchData() {
            axios.get('/api/profile')
            .then((response) => {
                this.user = response.data;
            })
        },
        delCar(item) {
            axios.post('/api/del-user-car/'+item.id)
            .then(() => {
                this.fetchData();
            })
        },
        addCar() {
            if(this.newCar.model) {
                this.newCar.model = this.newCar.model.title;
            }
            if(this.newCar.series) {
                this.newCar.series = this.newCar.series.title;
            }
            axios.post('/api/user-car', this.newCar)
            .then(() => {
                this.carModal = false;
                this.fetchData();
            })
        }
    }
}
</script>
<style lang="css" scoped>
    .table {
        width: auto;
        color: #373B53;
        padding: 15px 0;
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
    }
</style>
