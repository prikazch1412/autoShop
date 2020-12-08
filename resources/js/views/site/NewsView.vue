<template>
    <b-container class="wrapper">
        <div class="news-title">{{ data.title }}</div>
        <img :src="data.photo">
        <p v-html="data.description"></p>
        <div style="clear:both;"></div>
        <hr>
        <div class="title">Коментарі</div>
        <div class="review-item" v-if="isLoggedIn">
            <div class="photo">
                <img class="avatar" :src="avatar" alt="">
            </div>
            <div class="text w-100">
                <b-form-textarea
                    id="textarea"
                    placeholder="Текст"
                    v-model="newComment.comment"
                ></b-form-textarea>
                <div class="text-right mt-2">
                    <b-button variant="outline-primary" @click="postComment">Надіслати</b-button>
                </div>
            </div>
        </div>
        <Comment v-for="(item, index) in data.comments" :comment="item" :key="index"></Comment>
    </b-container>
</template>
<script>
import Comment from "../../components/site/CommentItem";
export default {
    components: {
        Comment
    },
    data() {
        return {
            data: {
                title: "",
                description: "",
                photo: "",
                comments: []
            },
            newComment: {
                comment: ""
            }
        }
    },
    computed: {
        avatar() {
            return this.$store.getters.authUser ? this.$store.getters.authUser.photo : "/img/no-image.png"
        },
        isLoggedIn() {
            return this.$store.getters.isLoggedIn
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        postComment() {
            if(this.isLoggedIn) {
                this.newComment.user_id = this.$store.getters.authUser.id
            }
            axios.post('/api/comment/'+this.$route.params.id, this.newComment)
            .then(() => {
                this.newComment.comment = "";
                this.fetchData();
            })
        },
        fetchData() {
            axios.get('/api/news/'+this.$route.params.id)
            .then((response) => {
                this.data = response.data;
            })
        }
    }
}
</script>
<style lang="css" scoped>
    .wrapper img {
        width: 40%;
        float: left;
        margin-right: 15px;
        border-radius: 10px;
    }
    .wrapper p {
        margin: 15px 0;
        display: inline;
        color: #7f7f7f;
        white-space: pre-wrap;
        text-indent: 1.3em;
    }
    .wrapper .news-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .wrapper {
        padding: 30px 40px;
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        margin-top: 40px;
    }
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
