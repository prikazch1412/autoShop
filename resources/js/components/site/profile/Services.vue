<template>
    <div>
        <b-row>
            <b-col cols="6" v-for="(item, index) in compareServices" :key="index">
                <div v-for="(i, index) in item" :key="index" class="checkbox-item">
                    <b-form-checkbox
                        v-model="i.selected"
                        value="1"
                        unchecked-value="0"
                        @change="selectService(i)"
                    >{{ i.title }}</b-form-checkbox>
                </div>
            </b-col>
        </b-row>
        <div v-for="(item, index) in selectServices" :key="index">
            <hr>
            <div class="title-item">{{ item.title }}</div>
            <b-row>
                <b-col cols="6" v-for="(item, index) in compareServiceItems(item.items)" :key="index">
                    <div v-for="(i, index2) in item" :key="index2" class="checkbox-item">
                        <b-form-checkbox
                            v-model="i.selected"
                            value="1"
                            unchecked-value="0"
                        >{{ i.title }} <input type="text" v-model="i.price" class="price" placeholder="Ціна"></b-form-checkbox>
                    </div>
                </b-col>
            </b-row>
        </div>
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
            services: [],
            user: {
                services: [],
                service_items: []
            }
        }
    },
    created() {
        this.fetchData();
        this.fetchServices();
    },
    computed: {
        compareServices() {
            var listServices = [];
            for (let i = 0; i < Math.ceil(this.services.length / (Math.round(this.services.length / 2))); i++){
                listServices[i] = this.services.slice((i * (Math.round(this.services.length / 2))), (i * (Math.round(this.services.length / 2))) + (Math.round(this.services.length / 2)));
            }
            return listServices;
        },
        selectServices() {
            return this.services.filter(item => item.selected == 1);
        }
    },
    methods: {
        selectService(item) {
            if(item.selected == 0) {
                item.items.forEach(element => {
                    element.selected = 0;
                })
            }
        },
        selectAll(item) {
            if(item.selectAll == true) {
                item.items.forEach(element => {
                    element.selected = 0;
                })
                item.selectAll = false;
            } else {
                item.items.forEach(element => {
                    element.selected = 1;
                })
                item.selectAll = true;
            }
        },
        fetchServices() {
            axios.get('/api/services')
            .then((response) => {
                this.services = response.data;
                this.services.forEach(item => {
                    if(this.user.services.find(i => i.service_id == item.id)) {
                        item.selected = 1;
                    }
                });
            })
        },
        fetchData() {
            axios.get('/api/profile')
            .then((response) => {
                this.user = response.data;
            })
        },
        compareServiceItems(items) {
            items.forEach(element => {
                var test = this.user.service_items.find(i => i.service_item_id == element.id);
                if(test) {
                    element.selected = 1;
                    element.price = test.price;
                }
            });
            var listServices = [];
            for (let i = 0; i < Math.ceil(items.length / (Math.round(items.length / 2))); i++){
                listServices[i] = items.slice((i * (Math.round(items.length / 2))), (i * (Math.round(items.length / 2))) + (Math.round(items.length / 2)));
            }
            return listServices;
        },
        save() {
            this.loading = true;
             axios.post('/api/profile', {
                services: this.services.filter(item => item.selected)
             }).then((response) => {
                this.user = response.data;
                this.loading = false;
            })
        }
    }
}
</script>
<style lang="css" scoped>
    .price {
        width: 50px;
        float: right;
        margin-left: 15px;
    }
    .checkbox-item {
        padding: 10px 0;
    }
    .title-item {
        color: #4B515B;
        font-size: 20px;
        line-height: 23px;
    }
    .selectAll {
        border: 0;
        outline: none;
        float: right;
        color: #196af7;
        background: #ffffff;
    }
</style>
