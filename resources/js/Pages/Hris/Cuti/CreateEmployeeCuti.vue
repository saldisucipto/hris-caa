<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages> Input Cuti Karyawan </title-pages>
        <!-- Endt Title Pages -->

        <!-- Main menu  -->
        <div class="m-3 bg-slate-100 rounded-lg">
            <div class="p-3 flex flex-col">
                <div>
                    <form
                        @submit.prevent="formCutiKaryawan"
                        class="p-5 flex flex-col w-full gap-5"
                    >
                        <div class="flex justify-center gap-3">
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Cari Karyawan</label
                                >
                                <button
                                    @click.prevent="openModal"
                                    class="bg-blue-400 my-auto py-1 rounded-lg text-white"
                                >
                                    Cari Karyawan
                                </button>
                            </div>
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Karyawan</label
                                >
                                <input
                                    type="text"
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    placeholder="Nama Karyawan"
                                    v-model="nama_karyawan"
                                    disabled
                                />
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.fileData"
                                >
                                    {{ errors.fileData }}
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Divisi</label
                                >
                                <input
                                    type="text"
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    placeholder="Divisi Karyawan"
                                    v-model="divisi_karyawan"
                                    disabled
                                />
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.fileData"
                                >
                                    {{ errors.fileData }}
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Sisa Cuti</label
                                >
                                <div class="text-xl font-semibold text-red-500">
                                    {{ sisa_cuti }} Hari
                                </div>
                            </div>
                        </div>

                        <button
                            class="bg-blue-400 hover:bg-blue-700 text-white py-1 rounded-md drop-shadow-sm"
                            type="submit"
                        >
                            Create Cuti
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Main Menu -->
    </div>
    <div
        v-if="modal"
        class="w-full h-screen backdrop-blur-sm absolute top-0 left-0 flex flex-col justify-center"
    >
        <div class="mx-auto w-full flex justify-center h-2/4">
            <div class="w-3/6 bg-white h-full my-auto drop-shadow-lg">
                <div class="p-4 flex flex-col justify-start gap-2">
                    <div class="flex justify-between gap-3">
                        <input
                            type="search"
                            class="drop-shadow-sm border py-1 px-3 rounded-md focus:outline-none text-sm w-full"
                            v-model="saerch_nama_karyawan"
                            name=""
                            placeholder="Cari Data Karyawan"
                            id=""
                        />
                        <button
                            class="bg-red-400 px-3 py-1 rounded-full text-white text-sm"
                            @click="openModal"
                        >
                            Closed
                        </button>
                    </div>
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
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <td
                                colspan="5"
                                class="text-center py-3"
                                v-if="this.dataKaryawan.length <= 0"
                            >
                                Belum Ada Data Karyawan
                            </td>
                            <tr
                                v-else
                                v-for="(employee, index) in this.dataKaryawan"
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
                            </tr>
                        </tbody>
                    </table>
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
            fileExcel: null,
            modal: false,
            nama_karyawan: "",
            divisi_karyawan: "",
            sisa_cuti: 0,
            saerch_nama_karyawan: "",
            dataKaryawan: [],
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
        karyawan: Object,
    },
    setup() {
        const form = useForm({
            saerch_nama_karyawan: "",
        });
        return { form };
    },

    methods: {
        formCutiKaryawan() {
            this.form.fileData = this.fileExcel;
            router.post("/hris/karyawan/import-data-karyawan", this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
        openModal() {
            router.get("/hris/karyawan/cuti/create", this.form);
            this.modal = !this.modal;
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
