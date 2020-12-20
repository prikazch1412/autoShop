<template>
    <div class="wrapper-profile">
        <div class="d-flex justify-content-center" v-if="preloader">
            <b-spinner style="width: 2rem; height: 2rem;" label="Large Spinner"></b-spinner>
        </div>
        <div class="mb-2" v-show="cars.length > 0">
            <b-button v-if="this.cars.find(item => item.selected == 0)" type="submit" variant="primary" @click="selectAll">Обрати всі</b-button>
            <b-button v-else type="submit" variant="primary" @click="clearAll">Відмінити всі</b-button>
        </div>
        <b-row>
            <b-col cols="4" v-for="(item, index) in compareCars" :key="index">
                <div v-for="(i, index) in item" :key="index" class="checkbox-item">
                    <b-form-checkbox
                        v-model="i.selected"
                        value="1"
                        unchecked-value="0"
                    >{{ i.title }}</b-form-checkbox>
                </div>
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
            preloader: true,
            loading: false,
            cars: [],
            user: {
                cars: []
            }
        }
    },
    created() {
        this.fetchData();
        this.fetchCars();
    },
    computed: {
        compareCars() {
            var listCars = [];
            for (let i = 0; i < Math.ceil(this.cars.length / 3); i++){
                listCars[i] = this.cars.slice((i * 3), (i * 3) + 3);
            }
            return listCars;
        }
    },
    methods: {
        fetchCars() {
            axios.get('/api/cars')
            .then((response) => {
                this.preloader = false;
                this.cars = response.data;
                this.cars.forEach(item => {
                    if(this.user.service_cars.find(i => i.model_id == item.id)) {
                        item.selected = 1;
                    }
                });
            }).catch(() => {
                this.preloader = false;
            });
        },
        fetchData() {
            axios.get('/api/profile')
            .then((response) => {
                this.user = response.data;
            })
        },
        save() {
            this.loading = true;
            this.user.services = null;
             axios.post('/api/profile', {
                cars: this.cars.filter(item => item.selected)
             }).then((response) => {
                this.user = response.data;
                this.loading = false;
            })
        },
        selectAll() {
            this.cars.forEach(element => {
                element.selected = 1;
            });
        },
        clearAll() {
            this.cars.forEach(element => {
                element.selected = 0;
            });
        }
    }
}
</script>
<style lang="css" scoped>
    .checkbox-item {
        padding: 10px 0;
    }
</style>
