<template>
<div>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col v-if="this.table == 'service_items'">
                            <v-select
                                label="Послуга"
                                v-model="newElement.service_id"
                                :items="services"
                                item-text="title"
                                item-value="id"
                            ></v-select>
                        </v-col>
                        <v-col>
                            <v-text-field v-model="newElement.title" label="Назва" required></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close()">Закрити</v-btn>
                <v-btn color="blue darken-1" text @click="save()">Зберегти</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-row>
        <v-col>
            <v-data-table
                :headers="headerServices"
                :items="services"
                :loading="loadingServices"
                item-key="id"
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>Послуги</v-toolbar-title>
                        <v-divider
                            class="mx-4"
                            inset
                            vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" dark class="mb-2" @click="addElement('services')">Додати</v-btn>
                    </v-toolbar>
                </template>

                <template v-slot:[`item.actions`]="{ item }">
                    <v-icon @click="delElement(item, 'services')">
                        delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-col>
        <v-col>
            <v-data-table
                :headers="headerServiceItems"
                :items="servicesItems"
                :loading="loadingServiceItems"
                item-key="id"
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>Вміння</v-toolbar-title>
                        <v-divider
                            class="mx-4"
                            inset
                            vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" dark class="mb-2" @click="addElement('service_items')">Додати</v-btn>
                    </v-toolbar>
                </template>

                <template v-slot:[`item.actions`]="{ item }">
                    <v-icon @click="delElement(item, 'service_items')">
                        delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-col>
    </v-row>
</div>
</template>

<script>
  export default {
    data: () => ({
        dialog: false,
        loadingServices: true,
        loadingServiceItems: true,
        editIndex: -1,
        table: "",
        newElement: {
            title: "",
            service_id: null
        },
        headerServices: [
            { text: '#', align: 'start', value: 'id', width: "20px" },
            { text: 'Назва', value: 'title' },
            { text: '', value: 'actions', sortable: false, align: 'right' },
        ],
        headerServiceItems: [
            { text: '#', align: 'start', value: 'id', width: "20px" },
            { text: 'Назва', value: 'title' },
            { text: 'Спеціалізація', value: 'service.title' },
            { text: '', value: 'actions', sortable: false, align: 'right' },
        ],
        services: [],
        servicesItems: []
    }),

    created() {
        this.getServices();
        this.getServicesItems();
    },

    methods: {
        getServices() {
            axios.get('/api/services')
                .then((response) => {
                    this.services = response.data;
                    this.loadingServices = false;
                })
        },
        getServicesItems() {
            axios.get('/api/services-items')
                .then((response) => {
                    this.servicesItems = response.data;
                    this.loadingServiceItems = false;
                })
        },
        addElement(table) {
            this.table = table;
            this.editIndex = -1;
            this.dialog = true;
        },
        save() {
            axios.post('/api/'+this.table, this.newElement)
                .then((response) => {
                    this.getServices();
                    this.getServicesItems();
                    this.close();
                })
        },
        delElement(item, table) {
            axios.post('/api/'+table+'/'+item.id)
                .then(() => {
                    this[table].splice(this[table].indexOf(item), 1);
                    this.close();
                })
        },
        close() {
            this.dialog = false;
            this.newElement = {};
        },
    }
  }
</script>
