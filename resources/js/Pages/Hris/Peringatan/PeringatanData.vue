<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages :backto="'/hris/karyawan'">
            Peringatan Karyawan
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
            <div class="h-12 bg-slate-100 rounded-lg flex justify-between">
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
                </div>
                <div class="mx-2 flex justify-between py-2 my-auto">
                    <div>
                        <a
                            class="py-1 px-3 rounded-md bg-blue-500 text-white"
                            href="/hris/karyawan/peringatan/create"
                            >Create Data</a
                        >
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
                                Peringatan
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Tanggal
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Tanggal Berakhir
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Status Peringatan
                            </th>

                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-if="this.data.data.length <= 0">
                            <td
                                colspan="6"
                                rowspan="6"
                                class="text-center py-8"
                            >
                                Belum ada Data Inputan
                            </td>
                        </tr>
                        <tr
                            v-else
                            v-for="(data, index) in data.data"
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
                                    {{ data.employee.nama_employee }}
                                </p>
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ data.jenis_peringatan.jenis_peringatan }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                {{ data.tanggal_peringatan }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 font-medium text-green-600"
                            >
                                {{ tanggalBerakhir(data.tanggal_peringatan) }}
                            </td>
                            <td
                                v-if="data.active"
                                class="whitespace-nowrap px-4 py-2 font-medium text-green-600"
                            >
                                Active
                            </td>
                            <td
                                v-else
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-600"
                            >
                                Done
                            </td>

                            <td
                                class="relative whitespace-nowrap py-2 flex gap-1 justify-center"
                            >
                                <button @click="modalOption(data.id)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div
                                    v-if="data.id == selectId"
                                    class="absolute rounded-md -top-5 right-10 bg-white drop-shadow-lg"
                                >
                                    <div class="p-3 flex justify-start">
                                        <div
                                            class="flex flex-col gap-2 text-xs text-left"
                                        >
                                            <button
                                                @click="deleteData(data.id)"
                                                class="text-left px-2 py-1 rounded-md hover:bg-red-600 hover:text-white"
                                            >
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
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
            saerch_nama_karyawan: "",
        });
        const deleteForm = useForm({
            id: "",
        });

        return { form, deleteForm };
    },
    components: {
        Navigasi,
        DashboardLayout,
        TitlePages,
        CardMasterData,
        Link,
    },
    props: {
        data: Object,
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
                router.get("/hris/karyawan/peringatan", this.form);
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
        statusPeringatan(date) {
            let datePunishment = new Date(date);
            let dateNow = new Date();
            let tanggalBerakhir = new Date(
                datePunishment.setMonth(datePunishment.getMonth() + 6)
            );

            // To calculate the time difference of two dates
            var perbedaan = tanggalBerakhir.getTime() - dateNow.getTime();
            let totalDays = Math.ceil(perbedaan / (1000 * 3600 * 24));

            let status = null;

            if (totalDays <= 0) {
                status = false;
            } else {
                status = true;
            }

            return status;
        },
        tanggalBerakhir(date) {
            let datePunishment = new Date(date);
            let tanggalBerakhir = datePunishment.setMonth(
                datePunishment.getMonth() + 6
            );
            return new Date(tanggalBerakhir).toLocaleDateString();
        },

        deleteData(id) {
            router.post(
                " /hris/karyawan/peringatan/delete/" + id,
                this.deleteForm,
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.deleteForm.reset();
                    },
                }
            );
        },
    },
};
</script>
