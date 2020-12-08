<template>
    <div class="wrapper-profile">
        <div class="d-flex justify-content-center" v-if="preloader">
            <b-spinner style="width: 2rem; height: 2rem;" label="Large Spinner"></b-spinner>
        </div>
        <div v-if="!preloader && user.reviews.length == 0" class="text-center">
            Відгуки відсутні
        </div>
        <Review v-for="(item, index) in user.reviews" :item="item" :key="index"></Review>
    </div>
</template>
<script>
import Review from '../../site/ReviewItem'
export default {
    components: {
        Review
    },
    data() {
        return {
            preloader: true,
            user: {
                reviews: []
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
    }
}
</script>
<style lang="css" scoped>

</style>
