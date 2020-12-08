import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

import uk from 'vuetify/src/locale/uk.ts';

Vue.use(Vuetify)

const opts = {
    icons: {
        iconfont: 'md',
    },
    lang: {
        locales: { uk },
        current: 'uk',
    },
}

export default new Vuetify(opts)
