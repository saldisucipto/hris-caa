<template>
    <div class="p-3 bg-white flex flex-col">
        <!-- Main menu  -->
        <div class="bg-slate-100">
            <div class="flex flex-col gap-3 mx-auto">
                <div class="grid grid-flow-col grid-cols-12 gap-2">
                    <div class="col-span-2">
                        <div class="w-full h-56 m-6">
                            <img
                                class="h-full w-full object-cover"
                                src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1287&q=80"
                                alt=""
                            />
                        </div>
                    </div>
                    <div
                        class="col-span-10 drop-shadow-sm flex flex-col text-gray-800"
                    >
                        <div class="m-6 flex flex-col gap-4">
                            <div class="flex justify-between">
                                <div
                                    v-if="karyawan.resign"
                                    class="text-xl font-semibold text-red-600"
                                >
                                    Karyawan Resign
                                </div>
                                <div v-else class="text-xl font-semibold">
                                    Profile Karyawan
                                </div>
                                <div>
                                    <a
                                        class="text-xl font-semibold"
                                        href="/hris/karyawan/data-karyawan"
                                    >
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <table
                                class="bg-slate-100 border text-left h-full w-full rounded-lg"
                            >
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2 w-1/4">
                                        Perusahaan
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.perusahaan.nama_company }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2 w-1/4">
                                        Nama
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.nama_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Jabatan
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.jabatan_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Grade
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.grade.grade }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        NIP (Karyawan)
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.nik_karyawan_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Tanggal Masuk
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{
                                            showDate(
                                                karyawan.tanggal_masuk_employee
                                            )
                                        }}
                                    </td>
                                </tr>
                                <tr
                                    v-if="karyawan.resign"
                                    class="h-10 hover:bg-white hover:h-12"
                                >
                                    <th class="px-2 font-normal border-2">
                                        Tanggal Resign
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 text-red-600"
                                    >
                                        {{
                                            showDate(
                                                karyawan.resign.tanggal_resign
                                            )
                                        }}
                                    </td>
                                </tr>
                                <tr
                                    v-if="karyawan.resign"
                                    class="h-10 hover:bg-white hover:h-12"
                                >
                                    <th class="px-2 font-normal border-2">
                                        Masa Kerja
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 text-red-600"
                                    >
                                        {{
                                            showDateCalculate(
                                                karyawan.tanggal_masuk_employee,
                                                true,
                                                karyawan.resign.tanggal_resign
                                            ) + " Tahun"
                                        }}
                                    </td>
                                </tr>
                                <tr
                                    v-else
                                    class="h-10 hover:bg-white hover:h-12"
                                >
                                    <th class="px-2 font-normal border-2">
                                        Masa Kerja
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{
                                            showDateCalculate(
                                                karyawan.tanggal_masuk_employee
                                            ) + " Tahun"
                                        }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Status Karyawan
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 uppercase"
                                    >
                                        {{ karyawan.status_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        No Bpjs TK
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 uppercase"
                                    >
                                        {{ karyawan.bpjs_tk_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        No Bpjs Kesehatan
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 uppercase"
                                    >
                                        {{ karyawan.bpjs_ks_employee }}
                                    </td>
                                </tr>
                                <tr
                                    v-if="karyawan.status_employee !== 'pkwtt'"
                                    class="h-10"
                                >
                                    <th class="px-2 font-normal border-2">
                                        Kontrak Awal
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 uppercase"
                                    >
                                        {{
                                            showDate(karyawan.masa_kontrak_awal)
                                        }}
                                    </td>
                                </tr>
                                <tr
                                    v-if="karyawan.status_employee !== 'pkwtt'"
                                    class="h-10"
                                >
                                    <th class="px-2 font-normal border-2">
                                        Kontrak Akhir
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 uppercase"
                                    >
                                        {{
                                            showDate(
                                                karyawan.masa_kontrak_akhir
                                            )
                                        }}
                                    </td>
                                </tr>
                            </table>
                            <div class="text-xl font-semibold text-ledt">
                                Data Pribadi Karyawan
                            </div>
                            <table
                                class="bg-slate-100 border text-left h-full w-full rounded-lg"
                            >
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        NIK KTP
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.nik_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        NIK KK
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.no_kk_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        NPWP
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 uppercase"
                                    >
                                        {{ karyawan.npwp_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Nama Ibu
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 uppercase"
                                    >
                                        {{ karyawan.nama_ibu_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2 w-1/4">
                                        Alamat
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{
                                            karyawan.alamat_employee +
                                            " RT/RW ." +
                                            karyawan.alamat_rt_employee +
                                            "/" +
                                            karyawan.alamat_rw_employee +
                                            " Kel." +
                                            karyawan.alamat_kel_employee +
                                            " Kec." +
                                            karyawan.alamat_kec_employee +
                                            " Kab." +
                                            karyawan.alamat_kab_employee +
                                            " - " +
                                            karyawan.alamat_prov_employee +
                                            " " +
                                            karyawan.alamat_kode_pos_employee
                                        }}
                                    </td>
                                </tr>

                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Email
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.email_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Nomer Telepon
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.phone_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Tempat, Tanggal Lahir
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{
                                            karyawan.tempat_lahir_employee +
                                            ", " +
                                            showDate(
                                                karyawan.tanggal_lahir_employee
                                            )
                                        }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Agama
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.agama_employee }}
                                    </td>
                                </tr>

                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Umur
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{
                                            showDateCalculate(
                                                karyawan.tanggal_lahir_employee
                                            ) + " Tahun"
                                        }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Jenis Kelamin
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.jenis_kelamin_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Nomer Rekening
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2"
                                    >
                                        {{ karyawan.bank_account_employee }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Status Pernikahan
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 capitalize"
                                    >
                                        {{
                                            karyawan.status_pernikahan_employee
                                        }}
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Jumlah Anak
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 capitalize"
                                    >
                                        {{ karyawan.jumlah_anak_employee }}
                                        Orang
                                    </td>
                                </tr>
                                <tr class="h-10 hover:bg-white hover:h-12">
                                    <th class="px-2 font-normal border-2">
                                        Pendidikan Terakhir
                                    </th>
                                    <td
                                        class="text-lg font-semibold px-2 border-2 capitalize"
                                    >
                                        {{ karyawan.last_edu }}
                                    </td>
                                </tr>
                            </table>
                        </div>
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
        karyawan: Object,
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
        showDate(date) {
            let dateTime = new Date(date).toLocaleDateString("id");
            return dateTime;
        },
        showDateCalculate(date, resign = false, dateResign = null) {
            let dateCalcualte = 0;
            let dateNow = 0;
            if (resign) {
                dateNow = new Date(dateResign);
            } else {
                dateNow = new Date();
            }
            dateCalcualte =
                dateNow.getFullYear() - new Date(date).getFullYear();
            return dateCalcualte;
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
