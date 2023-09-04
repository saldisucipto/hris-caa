<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <div class="flex justify-between pr-3">
            <div class="text-xl font-semibold text-ledt">
                <title-pages> Karyawan Resign </title-pages>
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
                        @submit.prevent="karyawanResign"
                        class="p-5 flex flex-col w-full gap-5"
                    >
                        <div class="flex justify-between gap-2">
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Karyawan Resign</label
                                >
                                <input
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    type="text"
                                    placeholder="Nama Karyawan"
                                    :value="karyawan.nama_employee"
                                    disabled
                                />
                            </div>
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Tanggal Resign
                                </label>
                                <input
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    type="date"
                                    placeholder="Nama Karyawan"
                                    v-model="form.tanggal_resign"
                                    min="2022-01-01"
                                    max="2025-01-01"
                                />
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.tanggal_resign"
                                >
                                    {{ errors.tanggal_resign }}
                                </div>
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

                        <button
                            class="bg-red-400 hover:bg-red-700 text-white py-1 rounded-md drop-shadow-sm"
                            type="submit"
                        >
                            Karyawan Resign
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
    },
    setup() {
        const form = useForm({
            id_employee: null,
            tanggal_resign: null,
            notes: "Catatan",
        });
        return { form };
    },

    methods: {
        karyawanResign() {
            this.form.id_employee = this.karyawan.id;
            router.post(
                "/hris/karyawan/resign/" + this.karyawan.id,
                this.form,
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                        this.errorsInput = false;
                    },
                }
            );
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
