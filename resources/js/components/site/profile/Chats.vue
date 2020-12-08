<template>
    <div class="wrapper-profile">
        <div class="d-flex justify-content-center" v-if="preloader">
            <b-spinner style="width: 2rem; height: 2rem;" label="Large Spinner"></b-spinner>
        </div>
        <div v-if="!preloader && data.length == 0" class="text-center">
            Діалоги відсутні
        </div>
        <b-row v-for="(item, index) in data" :key="index" class="notification" @click="openMessage(item.id)">
            <b-col cols="6"><b>{{ item.messages[item.messages.length - 1].user.user_role_id == 2 || item.messages[item.messages.length - 1].user.user_role_id == 1 ? item.messages[item.messages.length - 1].user.name : item.messages[item.messages.length - 1].user.service_name }}</b></b-col>
            <b-col cols="6" class="text-right">
                {{ item.date }}
            </b-col>
            <b-col>
                {{ item.messages[item.messages.length - 1].text }}
            </b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            preloader: true,
            data: []
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/chats')
            .then((response) => {
                this.preloader = false;
                this.data = response.data;
            }).catch(() => {
                this.preloader = false;
            });
        },
        openMessage(id) {
            this.$router.push({path: '/profile/chat/'+id});
        }
    },
}
</script>
<style lang="css" scoped>
    .notification {
        cursor: pointer;
        background: #fff;
        margin: 0 auto;
        border-radius: 3px;
        padding: 10px 15px;
        border: 1px solid rgb(231, 231, 231);
        box-shadow: 0 0 1px rgba(0,0,0,0.2);
        margin-bottom: 5px;

    }
    .notification:hover {
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }
</style>
