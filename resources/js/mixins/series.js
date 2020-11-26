export const series = {
    data() {
        return {
            series: []
        }
    },
    methods: {
        fetchSeries() {
            axios.get('/api/series')
            .then((response) => {
                this.series = response.data;
            })
        },
    },
}
