<template>
    <div>
        <b-row class="mb-3">
            <b-col>
                Марка
            </b-col>
            <b-col>
                Серия
            </b-col>
            <b-col>
                Год
            </b-col>
            <b-col></b-col>
        </b-row>
        <b-row v-for="i in 3" :key="i" class="table">
            <b-col>
                ZAZ
            </b-col>
            <b-col>
                TAVRIA
            </b-col>
            <b-col>
                1998
            </b-col>
            <b-col class="text-right">
                <b-icon icon="x" font-scale="1.5"></b-icon>
            </b-col>
        </b-row>
        <div class="buttons-profile">
            <b-button type="submit" variant="primary">Додати +</b-button>
        </div>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="css" scoped>
    .table {
        width: auto;
        color: #373B53;
        padding: 15px 0;
        background: #FFFFFF;
        box-shadow: 0px 3px 6px rgba(75, 81, 91, 0.15), 0px 1px 3px rgba(0, 0, 0, 0.15);
    }
</style>
