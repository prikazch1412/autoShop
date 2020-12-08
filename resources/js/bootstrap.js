import Echo from 'laravel-echo';
import Larasocket from 'larasocket-js';

window.axios = require('axios');
window.swal = require('sweetalert');
window.$ = window.jQuery = require('jquery');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Echo = new Echo({
    broadcaster: Larasocket,
    token: "473|FISzs87wfWySOenCJnp6xVDyEmh3m0wgmJ27MaGmyljuOXtW9hc2E2xjYvMstu9oIptAyp2SeV4GjLrx",
    debug: false
});
