export const services = {
    data() {
        return {
            services: [],
            servicesItems: []
        }
    },
    methods: {
        fetchServices() {
            axios.get('/api/services')
            .then((response) => {
                this.services = response.data;
            })
        },
        fetchServicesItems() {
            axios.get('/api/services-items')
            .then((response) => {
                this.servicesItems = response.data;
            })
        },
    },
}
