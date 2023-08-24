import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import VueApexCharts from "vue3-apexcharts";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueApexCharts)
            .mount(el);
    },
});
