<template>
<div>
    <div class="order-item" v-for="i in 5" :key="i">
        <div class="photo">
            <img class="avatar" src="/img/avatar.png" alt="">
        </div>
        <div class="text">
            <div>
                <b>Misha Otroshenko</b> Тел: 0994692170 <span>12.12.2020</span>
                <b-icon class="del-review" icon="x" font-scale="1.5"></b-icon>
                <b-icon class="del-review" icon="check2" font-scale="1.5"></b-icon><br>
                Статсус: виконано
            </div>
            <hr>
            <b-row>
                <b-col>
                    <div>Авто: ZAZ TAVRIA</div>
                    <div>Час: 12:00</div>
                    <div>Комент: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat illo, eligendi autem veniam dicta sequi obcaecati nobis</div>
                </b-col>
                <b-col>
                    <div>Список послуг</div>
                    <div v-for="i in 5" :key="i">
                        Test {{i}}
                    </div>
                </b-col>
            </b-row>
        </div>
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
    .order-item .form-control {
        width: 100%;
    }
    .order-item .photo img {
        width: 100%;
    }
    .order-item .photo {
        width: 100px;
        display: inline-block;
    }
    .order-item .text {
        margin-left: 15px;
        display: inline-block;
    }
    .order-item .text span {
        color: #A6ACBE;
        font-size: 14px;
    }
    .order-item {
        padding: 15px;
        display: flex;
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        margin-bottom: 15px;
    }
</style>
