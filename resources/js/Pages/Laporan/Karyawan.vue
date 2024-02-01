<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-2">
        <!-- Title Pages -->
        <title-pages :backto="'/dashboard/laporan'">
            Laporan Karyawan
        </title-pages>
        <!-- Endt Title Pages -->
        <!-- Konten Laporan -->
        <div class="bg-slate-50 rounded-md my-2 mx-4 text-gray-600">
            <div class="my-2 mx-4 flex flex-col gap-2">
                <h1 class="font-semibold text-gray-600">Filter Data</h1>
                <div
                    class="h-10 bg-white rounded-lg flex flex-col justify-center px-2"
                >
                    <div class="flex justify-between">
                        <div
                            class="{{if(errors.company) 'flex-col gap-3' else 'flex gap-1'}}"
                        >
                            <select
                                class="text-sm font-semibold border rounded-md focus:outline-none py-1 px-2"
                                name=""
                                v-model="perusahaan"
                            >
                                <option selected disabled value="">
                                    Pilih Perusahaan
                                </option>
                                <option
                                    v-for="companyData in company"
                                    :value="companyData.id"
                                >
                                    {{ companyData.nama_company }}
                                </option>
                            </select>

                            <!-- <div class="flex gap-1 text-xs">
                                <input
                                    type="checkbox"
                                    placeholder="Dengan Masa Kerja"
                                    name=""
                                    id=""
                                />
                                <label class="my-auto" for="">Masa Kerja</label>
                            </div>
                            <div class="flex gap-1 text-xs">
                                <input
                                    type="checkbox"
                                    placeholder="Dengan Masa Kerja"
                                    name=""
                                    id=""
                                />
                                <label class="my-auto" for="">Sisa Cuti</label>
                            </div>
                            <div class="flex gap-1 text-xs">
                                <input
                                    type="checkbox"
                                    placeholder="Dengan Masa Kerja"
                                    name=""
                                    id=""
                                />
                                <label class="my-auto" for=""
                                    >Status Karyawan</label
                                >
                            </div> -->
                        </div>

                        <div class="my-auto">
                            <button
                                class="px-2 py-1 bg-blue-400 rounded-md text-sm font-semibold text-gray-50"
                                @click="prosesLaporan"
                            >
                                Proses Laporan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="text-xs px-1 text-red-600" v-if="errors.company">
                    {{ errors.company }}
                </div>
            </div>
        </div>

        <!-- End Konten Laporan -->
        <!-- End Main Menu -->
    </div>
</template>

<script>
import Navigasi from "../Widgets/Navigasi.vue";
import DashboardLayout from "../Layouts/DashboardLayout.vue";
import TitlePages from "../Widgets/TitlePages.vue";
import CardLapData from "../Widgets/CardLapData.vue";
import { router, useForm } from "@inertiajs/vue3";

export default {
    setup() {
        const formReport = useForm({
            company: "",
        });

        return { formReport };
    },
    data() {
        return {
            perusahaan: "",
        };
    },
    components: {
        Navigasi,
        DashboardLayout,
        TitlePages,
        CardLapData,
    },
    props: {
        company: Object,
        errors: Object,
    },
    layout: DashboardLayout,
    methods: {
        prosesLaporan() {
            this.formReport.company = this.perusahaan;
            router.post("/hris/laporan/karyawan", this.formReport, {
                preserveScroll: true,
                onSuccess: () => {
                    this.formReport.reset();
                    console.log("done");
                },
                onProgress: () => {
                    console.log("loading");
                },
            });
        },
    },
};
</script>

<style></style>
