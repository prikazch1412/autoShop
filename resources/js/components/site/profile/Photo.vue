<template>
    <div>
        <b-row>
            <b-col cols="9">
                <div class="upload-files">
                    <b-form-file
                        v-model="file"
                        placeholder="Виберіть файл..."
                        drop-placeholder="Перетягніть файл сюди..."
                        multiple
                        :file-name-formatter="formatNames"
                    ></b-form-file>
                </div>
            </b-col>
            <b-col>
                <b-button type="submit" block variant="primary" @click="save">
                    <span
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"
                        v-if="loading"
                    ></span>
                    <span class="sr-only" v-if="loading">Loading...</span>
                    Зберегти
                </b-button>
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="4" v-for="(item, index) in user.photos" :key="index" class="photo-item mb-4">
                <b-icon @click="delPhoto(item)" class="del-photo" icon="x" font-scale="1.5"></b-icon>
                <img :src="item.src" alt="">
            </b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            file: null,
            foto: [],
            loading: false,
            user: {
                photos: []
            }
        }
    },
    created() {
		this.fetchData();
    },
    methods: {
        save() {
            this.loading = true;
            var form = new FormData;
            for(let i = 0; i < this.file.length; i++){
                form.append('pics[]', this.file[i]);
            }
            axios.post('/api/profile/photo', form)
                .then((res) => {
                    this.file = null;
                    this.fetchData();
                    this.loading = false;
                })
        },
        formatNames(files) {
            return files.length === 1 ? files[0].name : `${files.length} обрано файлів`
        },
        fetchData() {
            axios.get('/api/profile')
            .then((response) => {
                this.user = response.data;
            })
        },
        delPhoto(item) {
            axios.post('/api/profile/del-photo/'+item.id)
            .then(() => {
                this.fetchData();
            })
        }
    }
}
</script>
<style lang="css" scoped>
    .uploadFiles {
        border: 1px solid silver;
        width: 100%;
        margin-top: 10px;
        padding: 10px 15px;
        border-radius: 5px;
    }
    .uploadFiles i {
        position: absolute;
        right: 10px;
    }
    .upload-files {
        margin-bottom: 20px;
    }
    .del-photo {
        cursor: pointer;
        position: absolute;
        right: 15px;
        color: #ffffff;
        background: #000000;
        border-radius: 0 10px 0 0;
    }
    .photo-item img {
        width: 100%;
        border-radius: 10px;
    }
</style>
