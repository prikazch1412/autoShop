<template>
    <b-container class="wrapper">
        <NewsItem></NewsItem>
    </b-container>
</template>
<script>
import NewsItem from "../../components/site/NewsItem";
export default {
    components: {
        NewsItem
    }
}
</script>
<style lang="css" scoped>
    .wrapper {
        margin-top: 40px;
    }
</style>
