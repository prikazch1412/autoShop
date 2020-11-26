<template>
    <div>
        <Review v-for="i in 5" :key="i"></Review>
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
                this.user = response.data;
            })
        },
    }
}
</script>
<style lang="css" scoped>

</style>
