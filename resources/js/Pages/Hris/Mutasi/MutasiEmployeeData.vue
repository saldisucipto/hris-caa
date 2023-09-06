<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages :backto="'/hris/karyawan'">
            Mutasi Data Employee
        </title-pages>
        <!-- Endt Title Pages -->
        <!-- Main menu  -->
        <div class="m-3 bg-slate-100 rounded-lg">
            <div
                class="h-12 bg-slate-100 rounded-lg flex flex-col justify-center"
            >
                <div class="px-3">
                    <input
                        type="search"
                        name=""
                        placeholder="Cari Karyawan"
                        id=""
                        class="rounded-lg px-2 py-2 focus:outline-none text-sm w-full"
                        v-model="form.jabatanAwal"
                        @keyup="searchData"
                    />
                </div>
            </div>

            <div class="overflow-x-auto">
                <table
                    class="w-full divide-y-2 divide-gray-200 bg-white text-sm"
                >
                    <thead
                        class="ltr:text-left rtl:text-right text-left overflow-hidden bg-slate-100"
                    >
                        <tr>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                No
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Nama Mutasi
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Tanggal Mutasi
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Jabatan Awal
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Jabatan Sekarang
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Asal
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Tujuan
                            </th>

                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-if="this.mutasi.data == []"></tr>
                        <tr
                            v-else
                            v-for="(mutasiData, index) in mutasi.data"
                            class="hover:bg-gray-200"
                        >
                            <td
                                class="whitespace-nowrap px-4 py-2 font-bold text-gray-900"
                            >
                                {{ ++index }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                <p class="uppercase">
                                    {{ mutasiData.employee.nama_employee }}
                                </p>
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ showDate(mutasiData.tanggal_mutasi) }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ mutasiData.jabatan_awal }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ mutasiData.jabatan_tujuan }}
                            </td>
                            <td
                                class="whitespace-nowrap uppercase px-4 py-2 font-medium text-center text-gray-900"
                            >
                                {{ mutasiData.company_asal.nama_company }}
                            </td>
                            <td
                                class="whitespace-nowrap uppercase px-4 py-2 font-medium text-center text-gray-900"
                            >
                                {{ mutasiData.company_tujuan.nama_company }}
                            </td>

                            <td
                                class="relative whitespace-nowrap py-2 flex gap-1 justify-center"
                            >
                                <button @click="modalOption(mutasiData.id)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div
                                    v-if="mutasiData.id == selectId"
                                    class="absolute rounded-md -top-5 right-10 bg-white drop-shadow-lg"
                                >
                                    <div class="p-3 flex justify-start">
                                        <div
                                            class="flex flex-col gap-2 text-xs text-left"
                                        >
                                            <a
                                                :href="
                                                    '/hris/karyawan/show-karyawan/' +
                                                    mutasiData.id
                                                "
                                                class="text-left px-2 py-1 rounded-md hover:bg-blue-600 hover:text-white"
                                            >
                                                <i class="fas fa-eye"></i>
                                                Details
                                            </a>

                                            <a
                                                :href="
                                                    '/hris/karyawan/delete-karyawan/' +
                                                    mutasiData.id
                                                "
                                                class="text-left px-2 py-1 rounded-md hover:bg-red-600 hover:text-white"
                                            >
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between gap-3 py-3">
                <div class="flex justify-left gap-2">
                    <div v-for="link in mutasi.links">
                        <a v-if="link.url !== null" :href="link.url">
                            <div
                                :class="
                                    link.active
                                        ? 'bg-blue-500 hover:bg-blue-700 border-none'
                                        : ''
                                "
                                class="px-4 py-1 rounded-md text-xs hover:bg-blue-700 bg-blue-400 text-white font-semibold"
                                v-html="link.label"
                            ></div>
                        </a>
                    </div>
                </div>
                <form method="get">
                    <select
                        class="text-sm px-2 py-1 focus:outline-none border rounded-lg border-gray-700"
                        v-model="this.count_data"
                        id=""
                        @change="changeCount"
                    >
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                </form>
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
            count_data: this.filter.countDisplay,
            selectId: null,
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
        mutasi: Object,
        filter: Object,
    },
    setup() {
        const form = useForm({
            jabatanAwal: null,
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
        showDate(date) {
            let dateTime = new Date(date).toLocaleDateString("id");
            return dateTime;
        },
        searchData() {
            clearTimeout();
            setTimeout(() => {
                router.get("/hris/karyawan/mutasi/", this.form);
            }, 1000);
        },
        modalOption(id) {
            this.selectId = id;
            setTimeout(() => {
                this.selectId = null;
            }, 4000);
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
