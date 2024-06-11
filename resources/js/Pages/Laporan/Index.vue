<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages> Halaman Laporan </title-pages>
        <!-- Endt Title Pages -->

        <!-- Main menu  -->
        <div class="grid grid-flow-row grid-cols-4 gap-5 mb-10">
            <!-- Card Master Data -->
            <button-lap-data
                :iconData="'fa fa-users'"
                @click="modalButtonController()"
            >
                Laporan Karyawan
            </button-lap-data>
            <!-- <card-master-data :linkTujuan="'servis'" :iconData="'fa-users-cog'"
                >Master Jasa & Sevices</card-master-data
            >
            <card-master-data :linkTujuan="'customer'" :iconData="'fa-users'"
                >Master Customer</card-master-data -->

            <!-- End Card Master Data -->
        </div>
        <!-- End Main Menu -->
    </div>
    <div
        v-if="modal"
        class="w-full min-h-screen backdrop-blur-sm absolute top-0 left-0 flex flex-col justify-center"
    >
        <div class="mx-auto w-full flex justify-center h-2/4">
            <div
                class="w-3/6 bg-white h-full my-auto drop-shadow-lg overflow-x-auto rounded-lg border"
            >
                <div class="p-4 flex flex-col justify-start gap-2">
                    <div class="flex justify-between">
                        <div class="text-lg font-semibold my-auto">
                            <h2>Create Laporan Karyawan</h2>
                        </div>
                        <button
                            class="bg-red-500 text-gray-100 px-6 py-1 rounded-md"
                            @click="modalButtonController()"
                        >
                            Close
                        </button>
                    </div>
                    <hr />
                    <div class="flex flex-col">
                        <form
                            class="flex flex-col gap-2"
                            @submit.prevent="submitLaporanKaryawan()"
                        >
                            <div class="flex gap-2 justify-between">
                                <div class="flex flex-1 flex-col gap-2">
                                    <label class="font-base text-lg"
                                        >Pilih Karyawan</label
                                    >
                                    <select
                                        class="py-2 border rounded-lg focus:outline-none"
                                        v-model="laporanKaryawanForm.company_id"
                                    >
                                        <option
                                            v-for="company in this.company"
                                            :value="company.id"
                                        >
                                            {{ company.nama_company }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex flex-1 gap-2">
                                    <div class="flex flex-col justify-center">
                                        <div class="flex flex-col gap-2">
                                            <label class="font-base text-lg"
                                                >Awal Periode</label
                                            >
                                            <div class="  ">
                                                <input
                                                    class="p-2 border rounded-lg focus:outline-none"
                                                    type="date"
                                                    v-model="
                                                        laporanKaryawanForm.periode_awal
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex flex-col gap-2">
                                            <label class="font-base text-lg"
                                                >Akhir Periode</label
                                            >
                                            <div class="  ">
                                                <input
                                                    class="p-2 border rounded-lg focus:outline-none"
                                                    type="date"
                                                    v-model="
                                                        laporanKaryawanForm.periode_akhir
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="bg-primary text-gray-50 text-lg py-2 rounded-lg"
                            >
                                Proses Laporan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navigasi from "../Widgets/Navigasi.vue";
import DashboardLayout from "../Layouts/DashboardLayout.vue";
import TitlePages from "../Widgets/TitlePages.vue";
import ButtonLapData from "../Widgets/ButtonLapData.vue";
import { router, useForm } from "@inertiajs/vue3";

export default {
    data() {
        return {
            modal: false,
        };
    },
    setup() {
        const laporanKaryawanForm = useForm({
            periode_awal: null,
            periode_akhir: null,
            company_id: 1,
        });

        return { laporanKaryawanForm };
    },
    components: {
        Navigasi,
        DashboardLayout,
        TitlePages,
        ButtonLapData,
    },

    props: {
        company: Object,
    },
    methods: {
        modalButtonController() {
            this.modal = !this.modal;
        },
        submitLaporanKaryawan() {
            router.post(
                "/hris/laporan/laporan-karyawan",
                this.laporanKaryawanForm
            );
        },
    },
    layout: DashboardLayout,
};
</script>

<style></style>
