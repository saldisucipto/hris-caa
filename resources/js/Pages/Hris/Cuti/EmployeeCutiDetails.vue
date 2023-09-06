<template>
    <div class="p-3 rounded-xl bg-white flex flex-col">
        <!-- Title Pages -->
        <title-pages :backto="'/hris/karyawan/cuti/'">
            Details Cuti Karyawan
        </title-pages>
        <!-- Endt Title Pages -->

        <!-- Main menu  -->
        <div class="m-3 bg-slate-100 rounded-lg">
            <div class="p-4">
                <div class="w-full">
                    <table class="text-left w-full">
                        <tr class="h-8 hover:bg-white hover:h-10">
                            <th class="px-2 font-semibold border-2 w-1/4">
                                Nama
                            </th>
                            <td class="px-2 border-2">
                                {{ data.nama_employee }}
                            </td>
                        </tr>
                        <tr class="h-8 hover:bg-white hover:h-10">
                            <th class="px-2 font-semibold border-2">Jabatan</th>
                            <td class="px-2 border-2">
                                {{ data.jabatan_employee }}
                            </td>
                        </tr>
                        <tr class="h-8 hover:bg-white hover:h-10">
                            <th class="px-2 font-semibold border-2">NIP</th>
                            <td class="px-2 border-2">
                                {{ data.nik_karyawan_employee }}
                            </td>
                        </tr>
                        <tr class="h-8 hover:bg-white hover:h-10">
                            <th class="px-2 font-semibold border-2">
                                Status Employee
                            </th>
                            <td class="px-2 border-2 uppercase">
                                {{ data.status_employee }}
                            </td>
                        </tr>
                        <tr class="h-8 hover:bg-white hover:h-10">
                            <th class="px-2 font-semibold border-2">
                                Sisa Cuti
                            </th>
                            <td class="px-2 border-2 uppercase">
                                {{ sisaCuti(data.cuti) }}
                            </td>
                        </tr>
                    </table>
                    <div class="py-2 font-semibold text-md">
                        <h1>Riwayat Cuti</h1>
                    </div>
                    <table class="w-full">
                        <thead class="border h-10 bg-slate-50 text-sm">
                            <th class="border font-semibold">No</th>
                            <th class="border font-semibold">Jenis Cuti</th>
                            <th class="border font-semibold">
                                Tanggal Mulai Cuti
                            </th>
                            <th class="border font-semibold">
                                Tanggal Akhir Cuti
                            </th>
                            <th class="border font-semibold">Jumlah Cuti</th>
                            <th class="border font-semibold">
                                Keterangan Cuti
                            </th>
                        </thead>
                        <tbody
                            class="border h-8 bg-slate-50 text-center text-sm"
                        >
                            <tr v-for="(cutiData, index) in data.cuti">
                                <td class="border font-semibold">
                                    {{ ++index }}
                                </td>
                                <td
                                    class="border font-semibold capitalize text-left text-xs"
                                >
                                    {{ cutiData.jenis_cuti.jenis_cuti }}
                                </td>
                                <td class="border font-semibold">
                                    {{ cutiData.tanggal_mulai_cuti }}
                                </td>
                                <td class="border font-semibold">
                                    {{ cutiData.tanggal_akhir_cuti }}
                                </td>
                                <td class="border font-semibold">
                                    {{ cutiData.jumlah_cuti }}
                                </td>
                                <td
                                    colspan="4"
                                    class="border font-normal text-left text-xs"
                                >
                                    {{ cutiData.keterangan_cuti }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="py-2 font-semibold text-md">
                        <h1>Jumlah Cuti Yang Terpakai</h1>
                        <span class="text-blue-600 text-lg">{{
                            jumlahCuti(data.cuti)
                        }}</span>
                    </div>
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
    },
    setup() {
        const form = useForm({
            fileData: null,
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
        sisaCuti(data) {
            let jatah_cuti = 12;
            let sisa_cuti = 0;

            data.forEach((element) => {
                sisa_cuti += element.jumlah_cuti;
            });
            return jatah_cuti - sisa_cuti + " Hari";
        },
        jumlahCuti(data) {
            let jumlah_cuti = 0;

            data.forEach((element) => {
                jumlah_cuti += element.jumlah_cuti;
            });
            return jumlah_cuti + " Hari";
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
