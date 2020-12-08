<template>
<div class="wrapper-profile">
    <div class="d-flex justify-content-center" v-if="preloader">
        <b-spinner style="width: 2rem; height: 2rem;" label="Large Spinner"></b-spinner>
    </div>
    <div v-if="!preloader && user.orders.length == 0" class="text-center">
        Замовлення відсутні
    </div>
    <div class="order-item" v-for="(item, index) in user.orders" :key="index">
        <div class="photo">
            <img class="avatar" v-if="item.client_id" :src="item.user.photo" alt="">
            <img class="avatar" v-else src="/img/no-image.png" alt="">
        </div>
        <div class="text">
            <div>
                <b>{{ item.name }}</b> Тел: {{ item.phone }} <span>{{ item.date }}</span>
                <b-icon @click="delOrder(item.id)" class="del-review cursor" icon="x" font-scale="1.5"></b-icon>
                <b-icon v-if="item.status == 0" @click="updateOrder(item.id)" class="del-review cursor" icon="check2" font-scale="1.5"></b-icon><br>
                Статсус: {{ item.status == 1 ? 'виконано' : "не виконано" }}
            </div>
            <hr>
            <b-row>
                <b-col>
                    <div>Авто: {{ item.car.model }} {{ item.car.series }} {{ item.car.year }}</div>
                    <div>Час: {{ item.time }}</div>
                    <div>Комент: {{ item.comment }}</div>
                </b-col>
                <b-col>
                    <div>Список послуг</div>
                    <div v-for="(i, index) in item.services" :key="index">
                        {{ i.item.title }} {{ i.price }} грн
                    </div>
                </b-col>
            </b-row>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            preloader: true,
            user: {
                orders: []
            }
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/profile')
            .then((response) => {
                this.preloader = false;
                this.user = response.data;
            }).catch(() => {
                this.preloader = false;
            });
        },
        delOrder(id) {
            axios.post('/api/del-order/'+id)
            .then(() => {
                this.fetchData();
            })
        },
        updateOrder(id) {
            axios.post('/api/update-order/'+id)
            .then(() => {
                this.fetchData();
            })
        }
    }
}
</script>
<style lang="css" scoped>
    .del-review {
        float: right;
    }
    .order-item .form-control {
        width: 100%;
    }
    .order-item .photo img {
        width: 100%;
    }
    .order-item .photo {
        width: 100px;
        display: inline-block;
    }
    .order-item .text {
        width: 100%;
        margin-left: 15px;
        display: inline-block;
    }
    .order-item .text span {
        color: #A6ACBE;
        font-size: 14px;
    }
    .order-item {
        padding: 15px;
        display: flex;
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        margin-bottom: 15px;
    }
</style>
