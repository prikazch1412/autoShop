<template>
    <div>
        <v-container>
            <v-form ref="form">
                <v-row>
                    <v-col cols="2" class="pb-0 text-right">
                        Заголовок
                    </v-col>
                    <v-col class="py-0">
                        <v-text-field
                            v-model="data.title"
                            outlined
                            dense
                            label="Заголовок"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="2" class="py-0 text-right">
                        Опис
                    </v-col>
                    <v-col class="py-0">
                        <VueTrix inputId="editor1" v-model="data.description" class="mb-5" />
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="2" class="pt-5 pb-0 text-right">
                        Картинка
                    </v-col>
                    <v-col class="pb-0">
                        <v-file-input
                            outlined
                            dense
                            ref="image_file"
                            accept="image/png, image/jpeg, image/jpg"
                            prepend-icon="photo_camera"
                            label="Выберіть картинку"
                            v-model="photo"
                            @change="previewFiles($event)"
                        ></v-file-input>
                        <img :src="data.photo">
                    </v-col>
                </v-row>
            </v-form>
            <v-divider class="mb-3"></v-divider>
            <v-btn depressed color="primary" @click="save">Зберегти</v-btn>
        </v-container>
    </div>
</template>
<script>
import VueTrix from "vue-trix";
export default {
    components: {
        VueTrix
    },
    data: () => ({
        photo: null,
        data: {
            id: "",
            title: "",
            description: "",
            photo: null
        }
    }),
    created() {
        this.getData();
    },
    methods: {
        previewFiles(event) {
            if (event) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.data.photo = e.target.result;
                }
                reader.readAsDataURL(event);
            }
        },
        getData() {
            if(this.$route.params.id) {
                axios.get('/api/news/'+this.$route.params.id).then(response => {
                    Object.assign(this.data, response.data);
                })
            }
        },

        save() {
            let formData = new FormData();
            formData.append('title', this.data.title);
            formData.append('description', this.data.description);
            formData.append('photo', this.photo);
            axios.post(this.$route.params.id ? '/api/news/' + this.$route.params.id : '/api/news', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(() => {
                    this.$router.push({path: '/admin/news'});
                })
        }
    }
}
</script>

<style lang="css" scoped>
    img {
        width: 30%
    }
    .trix-button-group .trix-button-group--file-tools {
        display: none !important;
    }
</style>
