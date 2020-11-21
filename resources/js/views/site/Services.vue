<template>
    <b-container>
        <div class="form-search">
            <b-row class="inputs m-0">
                <b-col class="pl-0">
                    <input type="text" placeholder="Послуга">
                    <div class="searchResult">
                        <div v-for="i in 0" :key="i" class="item">
                            Item {{i}}
                        </div>
                    </div>
                </b-col>
                <b-col>
                    <input type="text" placeholder="Авто">
                    <div class="searchResult">
                        <div v-for="i in 0" :key="i" class="item">
                            Item {{i}}
                        </div>
                    </div>
                </b-col>
                <b-col>
                    <input type="text" placeholder="Серія">
                    <div class="searchResult">
                        <div v-for="i in 0" :key="i" class="item">
                            Item {{i}}
                        </div>
                    </div>
                </b-col>
                <b-col>
                    <input type="text" placeholder="Місто">
                    <div class="searchResult">
                        <div v-for="i in 0" :key="i" class="item">
                            Item {{i}}
                        </div>
                    </div>
                </b-col>
                <b-col>
                    <input type="text" placeholder="Район">
                    <div class="searchResult">
                        <div v-for="i in 0" :key="i" class="item">
                            Item {{i}}
                        </div>
                    </div>
                </b-col>
                <b-col class="pr-0">
                    <button class="button">Пошук</button>
                </b-col>
            </b-row>

            <b-row class="inputs ml-0 mr-0 mt-4" v-if="moreFilter">
                <b-col class="pl-0">
                    <b-form-checkbox
                        id="checkbox-service"
                        name="checkbox-service"
                    >
                        Сервіс
                    </b-form-checkbox>
                </b-col>
                <b-col>
                    <b-form-checkbox
                        id="checkbox-person"
                        name="checkbox-person"
                    >
                        Спеціаліст
                    </b-form-checkbox>
                </b-col>
                <b-col>
                    <date-picker type="time" placeholder="Бажаний час"></date-picker>
                </b-col>
                <b-col>

                </b-col>
                <b-col>

                </b-col>
                <b-col class="pr-0"></b-col>
            </b-row>

            <div class="more-filter" @click="moreFilter = !moreFilter">
                Розширений пошук {{ moreFilter ? "&and;" : "&or;" }}
            </div>
        </div>

        <b-row>
            <b-col v-for="i in 3" :key="i">
                <ServiceItem></ServiceItem>
            </b-col>
        </b-row>
    </b-container>
</template>
<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import ServiceItem from "../../components/site/ServiceItem";
export default {
    components: {
        ServiceItem,
        DatePicker
    },
    data() {
        return {
            moreFilter: false
        }
    }
}
</script>
<style lang="css" scoped>
    .more-filter {
        text-align: center;
        padding: 10px 0;
    }
    .form-search {
        margin: 40px 0;
    }
    .form-search .button {
        width: 100%;
        color: #ffffff;
        font-weight: bold;
        background: #051F61;
        border: 0;
        padding: 10px 0;
        border-radius: 10px;
    }
    .form-search .inputs {
        display: flex;
        align-items: center;
    }
    .form-search .inputs input {
        border-radius: 5px;
        background: #ffffff;
        width: 100%;
        padding: 10px;
        border: 0;
        box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
        outline: none;
    }
</style>
