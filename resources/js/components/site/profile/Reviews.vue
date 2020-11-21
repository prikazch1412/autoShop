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
    }
}
</script>
<style lang="css" scoped>

</style>
