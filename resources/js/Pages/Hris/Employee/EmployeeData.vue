<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages :backto="'/hris/karyawan'">
            Manajemen Karyawan
        </title-pages>
        <!-- Endt Title Pages -->
        <!-- Mesasge -->
        <div
            v-if="$page.props.flash.message"
            class="mx-3 h-12 bg-green-400 rounded-lg flex flex-col justify-center"
        >
            <div class="mx-4 flex justify-between py-2">
                <div class="my-auto font-semibold text-white">
                    {{ $page.props.flash.message }}
                </div>
                <div class="flex gap-3">
                    <button
                        class="bg-white my-auto text-xs rounded-lg font-semibold py-2 px-3 text-green-400 hover:drop-shadow-sm"
                        @click="$page.props.flash.message = null"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- End Message -->
        <!-- Main menu  -->
        <div class="mx-3 flex flex-col gap-1">
            <div
                class="h-12 bg-slate-100 rounded-lg flex flex-col justify-center"
            >
                <div class="mx-2 flex justify-between py-2">
                    <div>
                        <input
                            type="search"
                            name=""
                            placeholder="Cari Karyawan"
                            id=""
                            class="rounded-lg px-2 py-2 focus:outline-none text-sm w-80"
                            v-model="form.namaKaryawan"
                            @keyup="searchData"
                        />
                    </div>
                    <select
                        class="text-sm focus:outline-none rounded-lg px-2"
                        name="id_company"
                        v-model="id_company"
                        @change="changeFilter"
                    >
                        <option class="text-sm" value="1">
                            PT. CIPTA ANEKA AIR
                        </option>
                        <option class="text-sm" value="2">
                            PT. CIPTA ANEKA SERVIS
                        </option>
                        <option class="text-sm" value="3">
                            PT. RAGAM ADI CATUR ESAJAYA
                        </option>
                    </select>

                    <div class="flex gap-3 justify-end my-auto">
                        <div>
                            <a
                                href="/hris/karyawan/buat-data-karyawan"
                                class="bg-blue-400 my-auto text-xs rounded-lg text-white py-2 px-3 hover:bg-white hover:text-blue-400 hover:drop-shadow-sm"
                            >
                                <i class="fas fa-plus"></i>
                                Input Data Karyawan Baru
                            </a>
                        </div>
                        <div>
                            <a
                                href="/hris/karyawan/import-data-karyawan"
                                class="bg-yellow-400 my-auto text-xs rounded-lg text-white py-2 px-3 hover:bg-white hover:text-blue-400 hover:drop-shadow-sm"
                            >
                                <i class="fas fa-plus"></i>
                                Import Data Karyawan
                            </a>
                        </div>
                    </div>
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
                                Nama
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                NIK (Karyawan)
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Jabatan
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Perusahaan
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Status Karyawan
                            </th>

                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-if="this.employee.data == []"></tr>
                        <tr
                            v-else
                            v-for="(employee, index) in employee.data"
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
                                    {{ employee.nama_employee }}
                                </p>
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ employee.nik_karyawan_employee }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ employee.jabatan_employee }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ employee.perusahaan.nama_company }}
                            </td>
                            <td
                                class="whitespace-nowrap uppercase px-4 py-2 font-medium text-center text-gray-900"
                            >
                                {{ employee.status_employee }}
                            </td>

                            <td
                                class="relative whitespace-nowrap py-2 flex gap-1 justify-center"
                            >
                                <button @click="modalOption(employee.id)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div
                                    v-if="employee.id == selectId"
                                    class="absolute rounded-md -top-5 right-10 bg-white drop-shadow-lg"
                                >
                                    <div class="p-3 flex justify-start">
                                        <div
                                            class="flex flex-col gap-2 text-xs text-left"
                                        >
                                            <a
                                                :href="
                                                    '/hris/karyawan/show-karyawan/' +
                                                    employee.id
                                                "
                                                class="text-left px-2 py-1 rounded-md hover:bg-blue-600 hover:text-white"
                                            >
                                                <i class="fas fa-eye"></i>
                                                Details
                                            </a>
                                            <a
                                                :href="
                                                    '/hris/karyawan/update-karyawan/' +
                                                    employee.id
                                                "
                                                class="text-left px-2 py-1 rounded-md hover:bg-yellow-600 hover:text-white"
                                            >
                                                <i class="fas fa-pen"></i>
                                                Update
                                            </a>
                                            <a
                                                :href="
                                                    '/hris/karyawan/delete-karyawan/' +
                                                    employee.id
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
                    <div v-for="link in employee.links">
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
import { Link, router, useForm } from "@inertiajs/vue3";

export default {
    data() {
        return {
            id_company: this.filter.perusahaan,
            count_data: this.filter.countDisplay,
            selectId: null,
            deleteModal: true,
        };
    },
    setup() {
        const form = useForm({
            id_company: "",
            countData: "",
            namaKaryawan: "",
        });

        return { form };
    },
    components: {
        Navigasi,
        DashboardLayout,
        TitlePages,
        CardMasterData,
        Link,
    },
    props: {
        chart: Object,
        employee: Object,
        filter: Object,
    },
    layout: DashboardLayout,
    methods: {
        changeFilter() {
            this.form.id_company = this.id_company;
            router.get("/hris/karyawan/data-karyawan/", this.form);
        },
        changeCount() {
            this.form.countData = this.count_data;
            this.form.id_company = this.id_company;
            router.get("/hris/karyawan/data-karyawan/", this.form);
        },
        searchData() {
            clearTimeout();
            setTimeout(() => {
                this.form.id_company = this.id_company;
                router.get("/hris/karyawan/data-karyawan/", this.form);
            }, 1000);
        },
        modalOption(id) {
            this.selectId = id;
            setTimeout(() => {
                this.selectId = null;
            }, 4000);
        },
        modalDelete() {
            this.deleteModal = !this.deleteModal;
        },
    },
};
</script>
