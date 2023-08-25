<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages> Import Data Karyawan </title-pages>
        <!-- Endt Title Pages -->

        <!-- Main menu  -->
        <div class="m-3 bg-slate-100 rounded-lg">
            <div class="p-3 flex flex-col">
                <div class="text-sm flex gap-1">
                    <i
                        class="fas fas fa-exclamation-circle text-yellow-400"
                    ></i>
                    <p class="font-semibold text-gray-800">
                        Pastikan file Excel Dalam Urutan Yang sesuai !
                    </p>
                </div>

                <div>
                    <form
                        @submit.prevent="importForm"
                        class="p-5 flex flex-col w-full gap-5"
                    >
                        <div class="flex flex-col gap-2">
                            <label class="text-gray-700 font-semibold"
                                >File Excel</label
                            >
                            <input
                                class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                type="file"
                                placeholder="File Import"
                                @input="this.fileExcel = $event.target.files[0]"
                            />
                            <div
                                class="text-xs px-1 text-red-600"
                                v-if="errors.fileData"
                            >
                                {{ errors.fileData }}
                            </div>
                        </div>

                        <button
                            class="bg-blue-400 hover:bg-blue-700 text-white py-1 rounded-md drop-shadow-sm"
                            type="submit"
                        >
                            Import Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Main Menu -->
    </div>
</template>

<script>
import Navigasi from "../../Widgets/Navigasi.vue";
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import TitlePages from "../../Widgets/TitlePages.vue";
import CardMasterData from "../../Widgets/CardMasterData.vue";
import { router, useForm } from "@inertiajs/vue3";

export default {
    data() {
        return {
            fileExcel: null,
        };
    },
    components: {
        Navigasi,
        DashboardLayout,
        TitlePages,
        CardMasterData,
    },
    props: {
        errors: Object,
    },
    setup() {
        const form = useForm({
            fileData: null,
        });
        return { form };
    },

    methods: {
        importForm() {
            this.form.fileData = this.fileExcel;
            router.post("/hris/karyawan/import-data-karyawan", this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
