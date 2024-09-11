import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import "../css/app.css";

//bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'

//font-awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faHeart,faUser,faEye } from '@fortawesome/free-regular-svg-icons';
import { faCartShopping,faAnglesRight,faArrowUpRightDots,faFire,faBasketShopping,faBoxOpen,faMagnifyingGlass,faChevronRight } from '@fortawesome/free-solid-svg-icons';
library.add(faHeart,faUser,faCartShopping,faEye,faAnglesRight,faArrowUpRightDots,faFire,faBasketShopping,faBoxOpen,faMagnifyingGlass,faChevronRight);

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(plugin)
            .mount(el);
    },
});
