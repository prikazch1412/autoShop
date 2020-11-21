import Echo from 'laravel-echo';
import Larasocket from 'larasocket-js';

window.axios = require('axios');
window.swal = require('sweetalert');
window.$ = window.jQuery = require('jquery');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Echo = new Echo({
    broadcaster: Larasocket,
    token: "3",
    debug: false
});
