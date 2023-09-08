<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <div class="grid grid-flow-col grid-cols-2 gap-4">
            <div
                class="h-32 bg-bg-primary rounded-md flex flex-col justify-center"
            >
                <div
                    class="flex justify-center hape:flex-col hape:justify-center gap-3"
                >
                    <div class="my-auto hape:mx-auto">
                        <i class="fas fa-building fa-2x text-blue-900"></i>
                    </div>
                    <div class="flex flex-col">
                        <div
                            class="font-semibold text-center text-gray-500 text-4xl"
                        >
                            {{ company }}
                        </div>
                        <div class="text-xs text-center text-gray-400">
                            <span>Company</span>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="h-32 bg-bg-primary rounded-md flex flex-col justify-center"
            >
                <div
                    class="flex justify-center hape:flex-col hape:justify-center gap-3"
                >
                    <div class="my-auto hape:mx-auto">
                        <i class="fas fa-users fa-2x text-secondary-color"></i>
                    </div>
                    <div class="flex flex-col">
                        <div
                            class="font-semibold text-center text-gray-500 text-4xl"
                        >
                            {{ employee }}
                        </div>
                        <div class="text-xs text-center text-gray-400">
                            <span>Karyawan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex hape:flex-col gap-4">
            <div
                class="flex-1 h-56 rounded-md bg-blue-400 text-white font-semibold flex flex-col justify-center p-3"
            >
                <div
                    class="flex hape:flex-col hape:overflow-scroll justify-center gap-2 mx-3"
                >
                    <img
                        class="drop-shadow-xl max-h-36 hape:hidden shadow-white"
                        :src="'./assets/img/welcome.png'"
                        alt=""
                    />
                    <div class="flex flex-col my-auto">
                        <h1 class="text-2xl hape:hidden py-3">
                            Hallo.. {{ $page.props.users.name }}
                        </h1>
                        <p class="text-sm font-thin">
                            Selamat Datang di Sistem HRIS
                            <b class="font-bold">CAA</b>
                        </p>
                        <p class="text-sm font-thin">
                            Anda bisa mengatur, Menambahkan dan Memperbaharui
                            Konten pada sistem ini.
                        </p>
                        <button
                            class="text-xs bg-slate-200 hape:my-0 py-1 px-3 rounded-md text-gray-900 my-5 w-32"
                        >
                            Tutorial
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="flex-1 h-56 rounded-md bg-bg-primary flex flex-col gap-3 p-3 overflow-y-scroll"
            >
                <div>
                    <div class="mb-3">
                        <span class="font-semibold text-gray-700 capitalize"
                            >Ulang Tahun Karyawan Bulan Ini
                            {{ this.ulangTahun.length }} Orang
                        </span>
                    </div>
                    <div
                        v-for="ulangTahunKaryawan in this.ulangTahun"
                        class="flex flex-col gap-2"
                    >
                        <div
                            class="bg-white rounded-md h-10 flex flex-col justify-center hover:bg-blue-300 hover:font-semibold hover:text-white"
                        >
                            <div class="px-3 flex justify-between">
                                <span class="text-sm capitalize">{{
                                    ulangTahunKaryawan.nama_employee
                                }}</span>
                                <span
                                    class="text-sm hape:flex hape:flex-col hape:text-center"
                                >
                                    <span class="text-xs">
                                        {{
                                            showDate(
                                                ulangTahunKaryawan.tanggal_lahir_employee
                                            )
                                        }}</span
                                    >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="rounded-md bg-bg-primary h-80 relative">
                <div class="flex flex-col m-2 py-3 gap-4">
                    <div>
                        <span class="font-semibold text-gray-800"
                            >Informasi & Notifikasi
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex-1 flex flex-col gap-2">
                            <div class="font-semibold text-gray-700">
                                <h1>Peringatan Aktif Karyawan</h1>
                            </div>
                            <div v-for="sp in this.peringatan">
                                <div
                                    v-if="
                                        statusPeringatan(sp.tanggal_peringatan)
                                    "
                                    class="bg-white rounded-md h-10 flex flex-col justify-center hover:bg-blue-300 hover:font-semibold hover:text-white"
                                >
                                    <div class="px-3 flex justify-between">
                                        <span class="text-sm">{{
                                            sp.employee.nama_employee
                                        }}</span>
                                        <div
                                            class="text-sm hape:flex hape:flex-col hape:text-center flex gap-2 my-auto"
                                        >
                                            <span class="text-xs text-red-600">
                                                {{
                                                    sp.jenis_peringatan
                                                        .jenis_peringatan
                                                }}</span
                                            >
                                            <span
                                                class="text-xs text-green-600"
                                            >
                                                Berakhir Pada =
                                                {{
                                                    tanggalBerakhir(
                                                        sp.tanggal_peringatan
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div
                                class="bg-white rounded-md h-10 flex flex-col justify-center hover:bg-blue-300 hover:font-semibold hover:text-white"
                            >
                                <div class="px-3 flex justify-between">
                                    <span class="text-sm"
                                        >Ulang Tahun Karyawan</span
                                    >
                                    <span
                                        class="text-sm hape:flex hape:flex-col hape:text-center"
                                        ><b class="my-auto h-full">2</b>
                                        <span class="text-xs"> Karyawan</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navigasi from "../Widgets/Navigasi.vue";
import DashboardLayout from "../Layouts/DashboardLayout.vue";

export default {
    components: {
        Navigasi,
        DashboardLayout,
    },
    props: {
        chart: Object,
        employee: Number,
        company: Number,
        peringatan: Object,
        ulangTahun: Object,
    },
    layout: DashboardLayout,
    methods: {
        tanggalBerakhir(date) {
            let datePunishment = new Date(date);
            let tanggalBerakhir = datePunishment.setMonth(
                datePunishment.getMonth() + 6
            );
            return new Date(tanggalBerakhir).toLocaleDateString();
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
        showDate(date) {
            let dateTime = new Date(date).toLocaleDateString("id");
            let dateNow = new Date();
            var dateCalcualte =
                dateNow.getFullYear() - new Date(date).getFullYear();

            return dateTime + " " + dateCalcualte + " Tahun ";
        },
    },
};
</script>

<style></style>
