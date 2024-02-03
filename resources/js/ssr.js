import {createInertiaApp, Head, Link} from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import {renderToString} from '@vue/server-renderer';
import {createSSRApp, h} from 'vue';
import GuestLayout from './Layouts/Guest/Layout.vue';

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: name => {
            const pages = import.meta.glob('./Views/**/*.vue', { eager: true });
            let page = pages[`./Views/${name}.vue`];

            page.default.layout = page.default.layout || GuestLayout;
            return page;
        },
        setup({App, props, plugin}) {
            return createSSRApp({render: () => h(App, props)})
                .use(plugin)
                .component('inertia-link', Link)
                .component('inertia-head', Head)
        },
    }),
)
