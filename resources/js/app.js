import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js'; // Correct import

import "../css/app.css";

// Vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import '@mdi/font/css/materialdesignicons.css';
import { mdi } from 'vuetify/iconsets/mdi';

//toastfication
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

// Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';

// // Font Awesome
// import { library } from '@fortawesome/fontawesome-svg-core';
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
// import { faUser, faEye, faBell, faHeart, faPenToSquare } from '@fortawesome/free-regular-svg-icons';
// import { faCartShopping, faAnglesRight, faArrowUpRightDots, faHome, faFire, faBasketShopping, faBoxOpen, faMagnifyingGlass, faChevronRight, faBars, faBagShopping, faPlus, faTrash, faCircleXmark } from '@fortawesome/free-solid-svg-icons';

// library.add(
//   faHeart, faUser, faCartShopping, faEye, faAnglesRight, faArrowUpRightDots, faFire,
//   faBasketShopping, faBoxOpen, faMagnifyingGlass, faChevronRight, faBars, faBagShopping,
//   faBell, faHome, faPlus, faPenToSquare, faTrash, faCircleXmark
// );
//font-awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUser,faEye,faBell,faHeart,faPenToSquare } from '@fortawesome/free-regular-svg-icons';
import { faCartShopping,faAnglesRight,faArrowUpRightDots,faHome,faFire,faBasketShopping,faBoxOpen,faMagnifyingGlass,faChevronRight,faBars,faBagShopping,faPlus,faTrash,faCircleXmark,faCircleMinus,faCirclePlus,faTrashCan,faXmark,faArrowLeft,faHeart as faSolidHeart,faArrowRightFromBracket,faEllipsis,faCircleCheck,faPhone,faEnvelope,faLocationDot, faLink,faBox,faList,faPercent} from '@fortawesome/free-solid-svg-icons';
library.add(faHeart,faUser,faCartShopping,faEye,faAnglesRight,faArrowUpRightDots,faFire,faBasketShopping,faBoxOpen,faMagnifyingGlass,faChevronRight,faBars,faBagShopping,faBell,faHome,faPlus,faPenToSquare,faTrash,faCircleXmark,faCircleMinus,faCirclePlus,faTrashCan,faXmark,faArrowLeft,faSolidHeart,faArrowRightFromBracket,faEllipsis,faCircleCheck,faPhone,faEnvelope,faLocationDot,faBox,faList,faPercent);

import { faFacebook,faTwitter,faInstagram,faLinkedin,faTiktok } from '@fortawesome/free-brands-svg-icons';
library.add(faFacebook,faTwitter,faInstagram,faLinkedin,faTiktok);

const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'mdi',
    sets: {
      mdi,
    },
  },
});

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
      const app = createApp({ render: () => h(App, props) });

      app
        .component('Link', Link)
        .component('font-awesome-icon', FontAwesomeIcon)
        .use(plugin)
          .use(vuetify)
          .use(Toast)
        .config.globalProperties.$route = route; // route for Link

      app.mount(el);
    },
  });
