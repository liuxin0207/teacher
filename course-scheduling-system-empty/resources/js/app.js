import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia';

const appName = import.meta.env.VITE_APP_NAME || '國中小排課系統範例';
const pinia = createPinia();

createInertiaApp({
    title: (title) => title ? `${title} - ${appName}` : appName,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
      const Ziggy = {
        ...props.initialPage.props.ziggy,
        location: new URL(props.initialPage.props.ziggy.url),
      };

      return createApp({ render: () => h(App, props) })
          .use(plugin)
          .use(pinia)
          .use(ZiggyVue, Ziggy)
          .component('Link', Link)
          .component('Head', Head)
          .mount(el);
    },
    progress: false,
});
