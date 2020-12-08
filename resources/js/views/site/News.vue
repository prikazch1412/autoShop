<template>
    <b-container class="wrapper-page wrapper">
        <div class="d-flex justify-content-center" v-if="preloader">
            <b-spinner style="width: 4rem; height: 4rem;" label="Large Spinner"></b-spinner>
        </div>
        <div v-if="!preloader && news.length == 0" class="text-center">
            Нічого не знайдено
        </div>
        <NewsItem :data="news"></NewsItem>
    </b-container>
</template>
<script>
import NewsItem from "../../components/site/NewsItem";
export default {
    components: {
        NewsItem
    },
    data() {
        return {
            preloader: true,
            news: []
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/news')
            .then((response) => {
                this.preloader = false;
                this.news = response.data;
            }).catch(() => {
                this.preloader = false;
            });
        }
    }
}
</script>
<style lang="css" scoped>
    .wrapper {
        margin-top: 40px;
    }
</style>
