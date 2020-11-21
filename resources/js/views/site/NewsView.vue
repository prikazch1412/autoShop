<template>
    <b-container class="wrapper">
        <div class="news-title">Lorem ipsum dolor</div>
        <img src="/img/news.png">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa rem, sequi omnis aut quaerat eos fugit qui inventore harum non adipisci! Impedit facere ullam labore cupiditate, quos velit quaerat soluta!</p>
        <div style="clear:both;"></div>
        <hr>
        <div class="title">Коментарі</div>
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
        <Comment v-for="i in 5" :key="i"></Comment>
    </b-container>
</template>
<script>
import Comment from "../../components/site/CommentItem";
export default {
    components: {
        Comment
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
