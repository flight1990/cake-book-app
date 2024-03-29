import {createInertiaApp, Head, Link} from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import {renderToString} from '@vue/server-renderer'
import {createSSRApp, h} from 'vue'

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: name => {
            const pages = import.meta.glob('./Views/**/*.vue', {eager: true});
            return pages[`./Views/${name}.vue`];
        },
        setup({App, props, plugin}) {
            return createSSRApp({render: () => h(App, props)})
                .use(plugin)
                .component('inertia-link', Link)
                .component('inertia-head', Head)
        },
    }),
)
