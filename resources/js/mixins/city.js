export const city = {
    data() {
        return {
            city: []
        }
    },
    methods: {
        fetchCity() {
            axios.get('/api/city')
            .then((response) => {
                this.city = response.data;
            })
        },
    },
}
