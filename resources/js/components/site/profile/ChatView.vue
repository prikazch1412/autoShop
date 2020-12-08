<template>
    <div>
        <div class="chat">
            <div class="d-flex justify-content-center" v-if="preloader">
                <b-spinner style="width: 2rem; height: 2rem;" label="Large Spinner"></b-spinner>
            </div>
            <div v-if="!preloader && messages == 0" class="text-center">
                Діалоги відсутні
            </div>
            <div v-for="(item, index) in messages" :key="index" :class="item.message.user_id == $store.getters.authUser.id ? 'alert alert-primary' : 'alert alert-secondary'">
                <div class="photo">
                    <img class="avatar" :src="item.user.photo">
                </div>
                <div class="text">
                    {{ item.message.text }}
                </div>
                <div class="date">
                    {{ item.message.created_at.substring(0, 10) }} {{ item.message.created_at.substring(11, 16) }}
                </div>
            </div>
        </div>
        <b-row>
            <b-col cols="10">
                <b-form-input v-model="newMessage"></b-form-input>
            </b-col>
            <b-col cols="2">
                <b-button variant="primary" @click="sendMessage">Надіслати</b-button>
            </b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            preloader: true,
            messages: [],
            newMessage: ''
        }
    },
    created() {
        this.fetchMessages();

        Echo.channel('chat-'+this.$route.params.id)
            .listen('MessageSentEvent', (e) => {
                console.log(e)
                this.messages.push(e);
            });
    },
    methods: {
        fetchMessages() {
            axios.get('/api/message/'+this.$route.params.id)
            .then(response => {
                this.preloader = false;
                this.messages = response.data;
            }).catch(() => {
                this.preloader = false;
            });
        },

        addMessage(message) {
            axios.post('/api/message/'+this.$route.params.id, {
                message
            }).then(response => {
                this.messages.push(response.data);
            });
        },

        sendMessage() {
            this.addMessage(this.newMessage);
            this.newMessage = '';
        }
    },
}
</script>
<style lang="css" scoped>
    .chat {
        height: 400px;
        overflow: auto;
    }
    .alert {
        float: left;
        width: 100%;
    }
    .alert .photo {
        width: 10%;
        height: 100%;
        float: left;
    }
    .alert .text {
        width: 90%;
        float: left;
    }
    .alert .date {
        width: 90%;
        float: right;
        text-align: right;
    }
    .alert .photo img {
        width: 40px;
        border-radius: 20px;
    }
</style>
