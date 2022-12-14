require('./bootstrap')

import Vue from 'vue'
import vuetify from './vuetify'

import App from './components/App'

const app = new Vue({
    el: '#v-app',
    components: {
        App
    },
    vuetify
})
