<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages :backto="'/hris/karyawan'"> Cuti Employee </title-pages>
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
        <div class="m-3 rounded-lg flex flex-col gap-3">
            <div
                class="h-12 bg-slate-100 rounded-lg flex flex-col justify-center"
            >
                <div class="px-3 flex gap-3">
                    <input
                        type="search"
                        name=""
                        placeholder="Cari Karyawan"
                        id=""
                        class="flex-1 rounded-lg px-2 py-2 focus:outline-none text-sm w-full"
                        v-model="form.saerch_nama_karyawan"
                        @keyup="searchData"
                    />

                    <div class="flex flex-1 gap-3 justify-end">
                        <a
                            href="/hris/karyawan/cuti/create-cuti-bersama"
                            class="bg-blue-600 text-xs text-white my-auto py-2 rounded-lg px-3"
                        >
                            <i class="fas fa-plus"></i> Input Cuti Bersama
                        </a>
                        <a
                            href="/hris/karyawan/cuti/create"
                            class="bg-blue-600 text-xs text-white my-auto py-2 rounded-lg px-3"
                        >
                            <i class="fas fa-plus"></i> Input Cuti Karyawan
                        </a>
                        <button
                            class="bg-green-600 text-xs text-white rounded-lg px-3"
                        >
                            <i class="fas fa-plus"></i> Input Jenis Cuti
                        </button>
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
                                Nama Karyawan
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Cuti Terakhir
                            </th>

                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Jabatan
                            </th>

                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Sisa Cuti
                            </th>

                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-if="this.data.data == []"></tr>
                        <tr
                            v-else
                            v-for="(dataData, index) in data.data"
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
                                    {{ dataData.nama_employee }}
                                </p>
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{
                                    showDate(
                                        dataData.cuti[0].tanggal_akhir_cuti
                                    )
                                }}
                            </td>

                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ dataData.jabatan_employee }}
                            </td>

                            <td
                                class="whitespace-nowrap uppercase px-4 py-2 font-medium text-center text-gray-900"
                            >
                                {{ sisaCuti(dataData.cuti) }}
                            </td>

                            <td
                                class="relative whitespace-nowrap py-2 flex gap-1 justify-center"
                            >
                                <button @click="modalOption(dataData.id)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div
                                    v-if="dataData.id == selectId"
                                    class="absolute rounded-md -top-5 right-10 bg-white drop-shadow-lg"
                                >
                                    <div class="p-3 flex justify-start">
                                        <div
                                            class="flex flex-col gap-2 text-xs text-left"
                                        >
                                            <a
                                                :href="
                                                    '/hris/karyawan/cuti/details/' +
                                                    dataData.id
                                                "
                                                class="text-left px-2 py-1 rounded-md hover:bg-blue-600 hover:text-white"
                                            >
                                                <i class="fas fa-eye"></i>
                                                Details
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
                    <div v-for="link in data.links">
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
    <div
        v-if="modalCreate"
        class="w-full h-screen backdrop-blur-sm absolute top-0 left-0 flex flex-col justify-center"
    >
        <div class="mx-auto max-w-screen-md h-2/4">
            <div class="w-full bg-white h-full my-auto drop-shadow-lg">
                <div class="p-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Voluptatibus incidunt molestias corrupti labore facere
                    obcaecati totam alias rem animi. Ab harum optio corrupti
                    sunt voluptatem, voluptas inventore iusto ipsum eaque!
                </div>
            </div>
        </div>
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
            selectId: null,
            modalCreate: false,
            count_data: this.filter.countDisplay,
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
        data: Object,
        filter: Object,
    },
    setup() {
        const form = useForm({
            saerch_nama_karyawan: null,
            countData: "",
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
        changeCount() {
            this.form.countData = this.count_data;
            router.get("/hris/karyawan/cuti/", this.form);
        },
        searchData() {
            clearTimeout();
            setTimeout(() => {
                router.get("/hris/karyawan/cuti/", this.form);
            }, 1000);
        },
        modalOption(id) {
            this.selectId = id;
            setTimeout(() => {
                this.selectId = null;
            }, 4000);
        },
        openModal() {
            this.modalCreate = !this.modalCreate;
        },

        sisaCuti(data) {
            let jatah_cuti = 12;
            let sisa_cuti = 0;

            data.forEach((element) => {
                sisa_cuti += element.jumlah_cuti;
            });
            return jatah_cuti - sisa_cuti + " Hari";
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
