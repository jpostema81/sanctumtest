require('./bootstrap');

import Vue from 'vue';
import App from './components/App';

// wait until DOM is loaded before loading vue root element
window.onload = function() {
    window.csrf_token = "{{ csrf_token() }}"

    const app = new Vue({
        el: '#app',
        created() {
            axios({ url: '/api/user', data: null, method: 'GET' }).then(resp => 
            {
                console.log(resp);
            })
            .catch(error => {
                console.log('error');
            });
        },
        render: (h) => h(App),
    });
};
