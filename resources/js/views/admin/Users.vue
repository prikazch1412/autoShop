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
          <v-toolbar-title>Користувачі</v-toolbar-title>
        </v-toolbar>
      </template>

      <template v-slot:[`item.photo`]="{ item }">
        <v-img v-if="item.photo" :src="item.photo" width="60px"></v-img>
      </template>

      <template v-slot:[`item.name`]="{ item }">
          <span v-if="item.user_role_id == 3">
              {{item.service_name}}
          </span>
          <span v-else>
              {{ item.name + " " + item.surname }}
          </span>
      </template>

      <template v-slot:[`item.status`]="{ item }">
          <v-select
            style="width: 100px;"
            v-model="item.status"
            :items="status"
            item-text="title"
            item-value="id"
            @change="editStatus(item)"
          ></v-select>
      </template>
    </v-data-table>
</template>

<script>
  export default {
    data: () => ({
        loading: true,
        status: [
            {
                id: 0,
                title: 'Заблокований'
            },
            {
                id: 1,
                title: 'Розброкований'
            },
        ],
        headers: [
            { text: 'Фото', value: 'photo' },
            { text: 'Прізвище, ім\'я / Назва сервісу', value: 'name' },
            { text: 'Email', value: 'email' },
            { text: 'Телефон', value: 'phone' },
            { text: 'Роль', value: 'user_role.title' },
            { text: 'Статус', value: 'status', sortable: false }
        ],
        data: [],
    }),

    created() {
        this.getData();
    },

    methods: {
        getData() {
            axios.get('/api/users')
                .then((response) => {
                    this.data = response.data;
                    this.loading = false;
                })
        },
        editStatus(item) {
            axios.post('/api/user/'+item.id, {
                status: item.status
            })
        }
    }
  }
</script>
