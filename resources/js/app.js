import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import GuestLayout from './Layouts/Guest/Layout.vue';
import AdminLayout from './Layouts/Admin/Layout.vue';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Views/**/*.vue', { eager: true });
        let page = pages[`./Views/${name}.vue`];

        let Layout = name.startsWith('Admin') ? AdminLayout : GuestLayout;
        page.default.layout = page.default?.layout || Layout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('inertia-link', Link)
            .component('inertia-head', Head)
            .mount(el)
    },
});
