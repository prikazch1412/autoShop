<template>
    <div class="review-item">
        <div class="photo">
            <img class="avatar" src="/img/avatar.png" alt="">
        </div>
        <div class="text">
            <div><b>name</b> <span>12.12.2020</span> <b-icon v-if="$route.name == 'profile-reviews'" class="del-review" icon="x" font-scale="1.5"></b-icon></div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur reprehenderit assumenda hic, error architecto, labore optio magni animi incidunt, quod id dolores natus quia excepturi veritatis. Sunt, soluta omnis. Incidunt.
        </div>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="css" scoped>
    .del-review {
        float: right;
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
