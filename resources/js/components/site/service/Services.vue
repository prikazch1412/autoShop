<template>
    <div>
        <div class="title">Послуги</div>
        <b-row>
            <b-col cols="4" class="service-title px-0">
                <div class="service-title-item" v-for="i in 6" :key="i">
                    Сервисное ТО
                </div>
            </b-col>
            <b-col class="service-dewcription">
                <div v-for="i in 12" :key="i" class="service-dewcription-item">
                    <div>Компьютерная диагностика</div><div class="filler"></div> <span>от <b>165</b> грн</span>
                </div>
            </b-col>
        </b-row>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="css" scoped>
    .title {
        color: #373B53;
        font-weight: 500;
        font-size: 30px;
        margin-bottom: 20px;
    }
    .service-dewcription-item {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: #4B515B;
    }
    .service-title {
        border: 1px solid rgba(0, 0, 0, 0.15);
        box-sizing: border-box;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 10px 0px 0px 10px;
    }
    .service-dewcription {
        padding-top: 15px;
        padding-bottom: 15px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        box-sizing: border-box;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
        border-radius: 0px 10px 10px 0px;
    }
    .service-title-item {
        padding: 15px 25px;
        color: #4B515B;
        cursor: pointer;
        font-size: 20px;
    }
    .service-title-item:hover {
        background: linear-gradient(180deg, #3095CE 0%, #5A5DD8 100%);
        color: #ffffff;
    }
</style>
