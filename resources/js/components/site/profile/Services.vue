<template>
    <div>
        <b-row>
            <b-col v-for="(item, index) in test" :key="index">
                <div v-for="(i, index) in item" :key="index" class="checkbox-item">
                    <b-form-checkbox>Item {{ i }}</b-form-checkbox>
                </div>
            </b-col>
        </b-row>
        <hr>
        <div class="title-item">Title</div>
        <b-row>
            <b-col v-for="(item, index) in test" :key="index">
                <div v-for="(i, index) in item" :key="index" class="checkbox-item">
                    <b-form-checkbox>Item {{ i }}</b-form-checkbox>
                </div>
            </b-col>
        </b-row>
        <div class="buttons-profile">
            <b-button type="submit" variant="primary">Зберегти</b-button>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            test: [
                [1, 2, 3],
                [1, 2, 3],
                [1, 2, 3]
            ]
        }
    }
}
</script>
<style lang="css" scoped>
    .checkbox-item {
        padding: 10px 0;
    }
    .title-item {
        color: #4B515B;
        font-size: 20px;
        line-height: 23px;
    }
</style>
