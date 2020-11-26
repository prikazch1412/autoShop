<template>
    <div>
        <div class="title">Відгуки</div>
        <div class="review-item" v-if="isLoggedIn">
            <div class="photo">
                <img class="avatar" :src="avatar" alt="">
            </div>
            <div class="text w-100">
                <b-form-textarea
                    placeholder="Текст"
                    v-model="newReview.comment"
                ></b-form-textarea>
                <div class="text-right mt-2">
                    <b-button variant="outline-primary" @click="postReview">Надіслати</b-button>
                </div>
            </div>
        </div>
        <Review
            v-for="(item, index) in reviews"
            :key="index"
            :item="item"
        ></Review>
    </div>
</template>
<script>
import Review from '../../site/ReviewItem'
export default {
    components: {
        Review
    },
    computed: {
        avatar() {
            return this.$store.getters.authUser ? this.$store.getters.authUser.photo : "/img/no-image.png"
        },
        isLoggedIn() {
            return this.$store.getters.isLoggedIn
        }
    },
    props: {
        reviews: Array
    },
    data() {
        return {
            newReview: {
                comment: ""
            }
        }
    },
    methods: {
        postReview() {
            axios.post('/api/reviews/'+this.$route.params.id, this.newReview)
            .then(() => {
                this.newReview.comment = "";
                this.$emit('update');
            })
        }
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
