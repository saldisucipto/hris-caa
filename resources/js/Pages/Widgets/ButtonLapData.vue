<template>
    <div
        class="h-20 bg-bg-primary hover:bg-blue-400 hover:drop-shadow-lg rounded-md drop-shadow-sm flex flex-col justify-center text-gray-700 hover:rounded-tr-full hover:text-white"
    >
        <button class="mx-auto flex gap-3 justify-center">
            <i :class="'fas ' + iconData + ' fa-2x my-auto'"></i>
            <span class="my-auto font-semibold"><slot></slot></span>
        </button>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "ButtonLapData",
    props: {
        linkTujuan: String,
        iconData: String,
    },
    components: {
        Link,
    },
};
</script>

<style></style>
