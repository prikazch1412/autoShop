export const cars = {
    data() {
        return {
            cars: []
        }
    },
    methods: {
        fetchCars() {
            axios.get('/api/cars')
            .then((response) => {
                this.cars = response.data;
            })
        }
    },
}
