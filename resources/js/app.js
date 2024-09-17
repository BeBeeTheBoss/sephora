import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Link } from '@inertiajs/vue3';

import "../css/app.css";

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css' // Import MDI CSS
import { mdi } from 'vuetify/iconsets/mdi' // Import MDI icon set

//bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'

//font-awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUser,faEye,faBell,faHeart,faPenToSquare } from '@fortawesome/free-regular-svg-icons';
import { faCartShopping,faAnglesRight,faArrowUpRightDots,faHome,faFire,faBasketShopping,faBoxOpen,faMagnifyingGlass,faChevronRight,faBars,faBagShopping,faPlus,faTrash } from '@fortawesome/free-solid-svg-icons';
library.add(faHeart,faUser,faCartShopping,faEye,faAnglesRight,faArrowUpRightDots,faFire,faBasketShopping,faBoxOpen,faMagnifyingGlass,faChevronRight,faBars,faBagShopping,faBell,faHome,faPlus,faPenToSquare,faTrash);

const vuetify = createVuetify({
    components,
    directives,
    directives,
    icons: {
      defaultSet: 'mdi',
      sets: {
        mdi,
      },
    },
  })

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('Link', Link)
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(plugin)
            .use(vuetify)
            .mount(el);
    },
});
