export const years = {
    computed: {
        years() {
            const year = new Date().getFullYear();
            return Array.from({length: year - 1949}, (value, index) => 1950 + index).reverse();
        },
    }
}
