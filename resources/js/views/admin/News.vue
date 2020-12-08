<template>
    <v-data-table
      :headers="headers"
      :items="data"
      :loading="loading"
      item-key="id"
      class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Новини</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn to="/admin/add-news" color="primary" dark class="mb-2">Додати новину</v-btn>
            </v-toolbar>
        </template>

        <template v-slot:[`item.actions`]="{ item }">
            <v-btn icon :href="'/admin/news/'+item.id">
                <v-icon>edit</v-icon>
            </v-btn>
            <v-icon @click="delElement(item)">
                delete
            </v-icon>
        </template>

    </v-data-table>
</template>

<script>
  export default {
    data: () => ({
        loading: true,
        headers: [
            { text: '#', align: 'start', value: 'id', width: "20px" },
            { text: 'Назва', value: 'title' },
            { text: 'Дата публікації', value: 'created_at' },
            { text: '', value: 'actions', sortable: false, align: 'right' },
        ],
        data: [],
    }),
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/api/news')
                .then((response) => {
                    this.data = response.data;
                    this.loading = false;
                })
        },
        delElement(item) {
            axios.post('/api/del-news/'+item.id)
                .then(() => {
                    this.data.splice(this.data.indexOf(item), 1);
                })
        }
    }
  }
</script>
