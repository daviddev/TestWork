export default {
    get(params) {
        return axios.get('/api/countries', {params})
    }
}
