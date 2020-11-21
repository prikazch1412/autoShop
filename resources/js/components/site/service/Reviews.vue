<template>
    <div>
        <div class="title">Відгуки</div>
        <div class="review-item">
            <div class="photo">
                <img class="avatar" src="/img/avatar.png" alt="">
            </div>
            <div class="text w-100">
                <b-form-textarea
                    id="textarea"
                    placeholder="Текст"
                ></b-form-textarea>
                <div class="text-right mt-2">
                    <b-button variant="outline-primary">Надіслати</b-button>
                </div>
            </div>
        </div>
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
    .review-item .form-control {
        width: 100%;
    }
    .review-item .photo img {
        width: 100%;
    }
    .review-item .photo {
        width: 100px;
        display: inline-block;
    }
    .review-item .text {
        margin-left: 15px;
        display: inline-block;
    }
    .review-item .text span {
        color: #A6ACBE;
        font-size: 14px;
    }
    .review-item {
        padding: 15px;
        display: flex;
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        margin-bottom: 15px;
    }
</style>
