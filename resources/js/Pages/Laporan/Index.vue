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
                            action="/hris/laporan/laporan-karyawan"
                            class="flex flex-col gap-10"
                            method="get"
                        >
                            <div class="flex gap-2 justify-between">
                                <div class="flex flex-1 flex-col gap-2">
                                    <label class="font-base text-lg"
                                        >Pilih Karyawan</label
                                    >
                                    <select
                                        class="py-2 border rounded-lg focus:outline-none"
                                        name="company_id"
                                    >
                                        <option selected value="all">
                                            All Employee
                                        </option>
                                        <option
                                            v-for="company in this.company"
                                            :value="company.id"
                                        >
                                            {{ company.nama_company }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex-1 gap-2">
                                    <div class="flex flex-col justify-center">
                                        <div class="flex flex-col gap-2">
                                            <label class="font-base text-lg"
                                                >Status Karyawan
                                            </label>

                                            <select
                                                class="py-2 border rounded-lg focus:outline-none uppercase"
                                                name="status_karyawan"
                                            >
                                                <option selected value="all">
                                                    All Employee
                                                </option>
                                                <option
                                                    class="uppercase"
                                                    v-for="status in status_karyawan"
                                                    :value="status.status"
                                                >
                                                    <span class="mx-2">{{
                                                        status.status
                                                    }}</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2 justify-center">
                                <button
                                    type="button"
                                    class="bg-yellow-600 text-gray-50 text-lg py-2 rounded-lg"
                                    @click="printJs()"
                                >
                                    <p class="px-3">
                                        <i class="fas fa-print"></i> Print
                                        Report
                                    </p>
                                </button>
                                <button
                                    type="submit"
                                    class="bg-primary text-gray-50 text-lg py-2 rounded-lg"
                                >
                                    <p class="px-3">
                                        <i class="fas fa-file-export"></i>
                                        Export Report Excel
                                    </p>
                                </button>
                                <button
                                    type="button"
                                    class="bg-green-600 text-gray-50 text-lg py-2 rounded-lg"
                                    @click="printJs()"
                                >
                                    <p class="px-3">
                                        <i class="fas fa-file-export"></i>
                                        Export Report PDF
                                    </p>
                                </button>
                            </div>
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
import printJS from "print-js";

export default {
    data() {
        return {
            modal: false,
            status_karyawan: [
                {
                    status: "pkwt",
                },
                {
                    status: "pkwtt",
                },
                {
                    status: "resign",
                },
            ],
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
            return router.get("/hris/laporan/laporan-karyawan");
        },
        printJs() {
            printJS({
                printable: [
                    {
                        name: "John Doe",
                        email: "john@doe.com",
                        phone: "111-111-1111",
                    },
                    {
                        name: "Barry Allen",
                        email: "barry@flash.com",
                        phone: "222-222-2222",
                    },
                    {
                        name: "Cool Dude",
                        email: "cool@dude.com",
                        phone: "333-333-3333",
                    },
                ],
                type: "json",
                properties: ["name", "email", "phone"],
                header: '<h3 class="custom-h3">My custom header</h3>',
                style: ".custom-h3 { color: red; }",
            });
        },
    },
    layout: DashboardLayout,
};
</script>

<style></style>
