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
            <v-toolbar-title>Замовлення</v-toolbar-title>
            </v-toolbar>
        </template>

        <template v-slot:[`item.user`]="{ item }">
            {{ item.user.name + " " + item.user.surname }}
        </template>

        <template v-slot:[`item.status`]="{ item }">
            {{ item.status ? 'Виконаний' : 'В роботі' }}
        </template>

        <template v-slot:[`item.actions`]="{ item }">
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
            { text: 'Замовник', value: 'person' },
            { text: 'Статус', value: 'status' },
            { text: '', value: 'actions', sortable: false, align: 'right' },
        ],
        data: [],
    }),
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/api/orders')
                .then((response) => {
                    this.data = response.data;
                    this.loading = false;
                })
        },
        delElement(item) {
            axios.post('/api/del-order/'+item.id)
                .then(() => {
                    this.data.splice(this.data.indexOf(item), 1);
                })
        }
    }
  }
</script>
