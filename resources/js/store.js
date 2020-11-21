import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        tokenAdmin: localStorage.getItem('tokenAdmin') || '',
        user: JSON.parse(localStorage.getItem('user')) || null
    },
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_user_success(state, token, user_data) {
            state.status = 'success'
            state.token = token
            state.user = user_data
        },
        auth_admin_success(state, token) {
            state.status = 'success'
            state.tokenAdmin = token
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = ''
            state.token = ''
            state.user = ''
        },
        user_data(state, user){
            state.user = user
        },
    },
    actions: {
        login({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/login', data: user, method: 'POST' })
                .then(resp => {
                    const token = resp.data.access_token
                    const user_data = resp.data.user
                    localStorage.setItem('user', JSON.stringify(user_data))
                    localStorage.setItem('token', token)
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_user_success', token, user_data)
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('token')
                    localStorage.removeItem('user')
                    reject(err)
                })
            })
        },
        loginAdmin({commit}, user) {
            return new Promise((resolve, reject) => {
                axios({url: '/api/login-admin', data: user, method: 'POST' })
                .then(resp => {
                    const token = resp.data.access_token
                    localStorage.setItem('tokenAdmin', token)
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_admin_success', token)
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('tokenAdmin')
                    reject(err)
                })
            })
        },
        register({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/register', data: user, method: 'POST' })
                .then(resp => {
                    const token = resp.data.access_token
                    const user_data = resp.data.user
                    localStorage.setItem('user', JSON.stringify(user_data))
                    localStorage.setItem('token', token)
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_success', token, user)
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error', err)
                    localStorage.removeItem('token')
                    localStorage.removeItem('user')
                    reject(err)
                })
            })
        },
        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token')
                localStorage.removeItem('user')
                localStorage.removeItem('tokenAdmin')
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })
        },
        user({commit}, user) {
            localStorage.setItem('user', JSON.stringify(user))
            commit('user_data', user)
        }
    },
    getters: {
        isLoggedIn: state => !!state.token,
        isLoggedInAdmin: state => !!state.tokenAdmin,
        authStatus: state => state.status,
        authUser: state => state.user,
    }
})
