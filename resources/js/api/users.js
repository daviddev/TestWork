export default {
    store(params) {
        return axios.post('/api/users', params)
    }
}
