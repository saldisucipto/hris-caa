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
                        <div class="flex gap-3">
                            <select
                                class="text-sm font-semibold border rounded-md focus:border-none active:border-none focus:outline-none p-2"
                                name=""
                                v-model="perusahaan"
                            >
                                <option
                                    v-for="companyData in company"
                                    :value="companyData.id"
                                >
                                    {{ companyData.nama_company }}
                                </option>
                            </select>
                            <div class="flex gap-1 text-xs">
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
                            </div>
                        </div>
                        <div class="my-auto">
                            <button
                                class="px-2 py-1 bg-blue-400 rounded-md text-sm font-semibold text-gray-50"
                            >
                                Proses Laporan
                            </button>
                        </div>
                    </div>
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

export default {
    data() {
        return {
            perusahaan: 1,
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
    },
    layout: DashboardLayout,
};
</script>

<style></style>
