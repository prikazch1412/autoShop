<template>
    <div>
        <v-toolbar flat>
            <v-toolbar-title>Про сайт</v-toolbar-title>
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
        </v-toolbar>
        <VueTrix inputId="editor1" v-model="info.about" class="mb-5" />
        <v-btn @click="saveInfo('about')" :loading="loadingButtons.about">Зберегти</v-btn>
    </div>
</template>

<script>
import VueTrix from "vue-trix";
export default {
    components: {
        VueTrix
    },
    data() {
        return {
            loadingButtons: {
                about: false
            },
            info: {
                about: ""
            }
        }
    },
    created() {
        this.getAbout();
    },
    methods: {
        getAbout() {
            axios.get('/api/info')
                .then((response) => {
                    response.data.map(item => {
                        this.info[item.key] = item.value;
                    });
                })
        },
        saveInfo(button) {
            this.loadingButtons[button] = true;
            axios.post('/api/info', {info: this.info})
                .then(() => {
                    this.loadingButtons[button] = false;
                })
        },
    }
}
</script>
