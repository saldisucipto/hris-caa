<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <div class="flex justify-between pr-3">
            <div class="text-xl font-semibold text-ledt">
                <title-pages> Mutasi Karyawan </title-pages>
            </div>
            <div class="my-auto">
                <a
                    class="text-xl font-semibold"
                    href="/hris/karyawan/data-karyawan"
                >
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
        <!-- Title Pages -->

        <!-- Endt Title Pages -->

        <!-- Main menu  -->
        <div class="m-3 bg-slate-100 rounded-lg">
            <div class="p-3 flex flex-col">
                <div class="text-sm flex gap-1">
                    <i
                        class="fas fas fa-exclamation-circle text-yellow-400"
                    ></i>
                    <p class="font-semibold text-gray-800">
                        Pastikan Isi Semua Kolom !
                    </p>
                </div>

                <div>
                    <form
                        @submit.prevent="mutasiData"
                        class="p-5 flex flex-col w-full gap-5"
                    >
                        <div class="flex justify-between gap-2">
                            <div class="flex flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Mutasi Karyawan</label
                                >
                                <input
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    type="text"
                                    placeholder="Nama Karyawan"
                                    :value="karyawan.nama_employee"
                                    disabled
                                />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Tanggal Mutasi
                                </label>
                                <input
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    type="date"
                                    placeholder="Nama Karyawan"
                                    v-model="form.tanggal_mutasi"
                                    min="2022-01-01"
                                    max="2025-01-01"
                                />
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.tanggal_mutasi"
                                >
                                    {{ errors.tanggal_mutasi }}
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Company Asal
                                </label>
                                <select
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    v-model="form.id_company_asal"
                                    name=""
                                    id=""
                                    disabled
                                >
                                    <option
                                        v-for="company in this.company"
                                        :value="company.id"
                                    >
                                        {{ company.nama_company }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Company Mutasi
                                </label>
                                <select
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    v-model="form.id_company_tujuan"
                                    name=""
                                    id=""
                                >
                                    <option
                                        v-for="company in this.company"
                                        :value="company.id"
                                    >
                                        {{ company.nama_company }}
                                    </option>
                                </select>
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.id_company_tujuan"
                                >
                                    {{ errors.id_company_tujuan }}
                                </div>
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="this.errorsInput"
                                >
                                    Company Tujuan Tidak Boleh sama Dengan
                                    Company Sebelumnya
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <div class="flex-1 flex flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Jabatan Awal</label
                                >
                                <input
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    type="text"
                                    placeholder="Jabatan Awal"
                                    :value="karyawan.jabatan_employee"
                                    disabled
                                />
                            </div>
                            <div class="flex-1 flex flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Jabatan Tujuan</label
                                >
                                <input
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    type="text"
                                    placeholder="Jabatan Setelah Di Mutasi"
                                    v-model="form.jabatan_tujuan"
                                    required
                                />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-gray-700 font-semibold"
                                >Catatan
                            </label>
                            <textarea
                                class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                name=""
                                id=""
                                cols="30"
                                rows="5"
                                v-model="form.notes"
                            ></textarea>
                        </div>
                        <div class="hidden flex-col gap-2">
                            <input
                                class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                type="text"
                                v-model="form.id_employee"
                                disabled
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
                            Mutasi Karyawan
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
            errorsInput: false,
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
        company: Object,
    },
    setup() {
        const form = useForm({
            id_employee: null,
            tanggal_mutasi: null,
            id_company_asal: null,
            id_company_tujuan: 1,
            jabatan_tujuan: null,
            notes: "Catatan",
        });
        return { form };
    },

    methods: {
        mutasiData() {
            this.form.fileData = this.fileExcel;
            this.form.id_employee = this.karyawan.id;
            if (this.karyawan.id_company == this.form.id_company_tujuan) {
                this.errorsInput = true;
                return;
            } else {
                router.post(
                    "/hris/karyawan/mutasi/" + this.karyawan.id,
                    this.form,
                    {
                        preserveScroll: true,
                        onSuccess: () => {
                            this.form.reset();
                            this.errorsInput = false;
                        },
                    }
                );
            }
        },
        loadData() {
            this.form.id_company_asal = this.karyawan.id_company;
        },
    },

    layout: DashboardLayout,
    mounted() {
        this.loadData();
    },
};
</script>

<style></style>
