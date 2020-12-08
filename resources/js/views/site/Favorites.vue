<template>
    <b-container class="wrapper-page mt-5">
        <div class="d-flex justify-content-center" v-if="preloader">
            <b-spinner style="width: 4rem; height: 4rem;" label="Large Spinner"></b-spinner>
        </div>
        <div v-if="!preloader && users.length == 0" class="text-center">
            Нічого не знайдено
        </div>
        <b-row>
            <b-col cols="4" v-for="(item, index) in users" :key="index">
                <ServiceItem :user="item.user"></ServiceItem>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
import ServiceItem from "../../components/site/ServiceItem";
export default {
    components: {
        ServiceItem
    },
    data() {
        return {
            preloader: true,
            users: []
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/favorites')
            .then((response) => {
                this.preloader = false;
                this.users = response.data;
            }).catch(() => {
                this.preloader = false;
            });
        }
    }
}
</script>
<style lang="css" scoped>

</style>
