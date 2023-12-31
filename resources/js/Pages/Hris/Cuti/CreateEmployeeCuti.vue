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
                                    v-if="errors.id_employee"
                                >
                                    {{ errors.id_employee }}
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Jabatan</label
                                >
                                <input
                                    type="text"
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    placeholder="Jabatan Karyawan"
                                    v-model="jabatan_employee"
                                    disabled
                                />
                            </div>

                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Lama Cuti</label
                                >
                                <div class="flex justify-start gap-2">
                                    <input
                                        type="number"
                                        min="0"
                                        max="10"
                                        class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm w-20"
                                        placeholder="Jumlah Cuti"
                                        v-model="cutiForm.jumlah_cuti"
                                    />
                                    <div
                                        class="text-xl font-semibold text-red-500"
                                    >
                                        {{ cutiForm.jumlah_cuti }} Hari
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center gap-3">
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Jenis Cuti</label
                                >
                                <select
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    v-model="cutiForm.id_jenis_cuti"
                                    name=""
                                    id=""
                                >
                                    <option
                                        v-for="jenisCuti in this.jenis_cuti"
                                        :value="jenisCuti.id"
                                    >
                                        {{ jenisCuti.jenis_cuti }}
                                    </option>
                                </select>

                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.fileData"
                                >
                                    {{ errors.fileData }}
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Mulai Cuti</label
                                >
                                <input
                                    type="date"
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    placeholder="Jabatan Karyawan"
                                    v-model="cutiForm.tanggal_mulai_cuti"
                                />
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.tanggal_mulai_cuti"
                                >
                                    {{ errors.tanggal_mulai_cuti }}
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Akhir Cuti</label
                                >
                                <input
                                    type="date"
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    v-model="cutiForm.tanggal_akhir_cuti"
                                    @change="kalkulasiTanggal()"
                                />
                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.tanggal_akhir_cuti"
                                >
                                    {{ errors.tanggal_akhir_cuti }}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center gap-3">
                            <div class="flex flex-1 flex-col gap-2">
                                <label class="text-gray-700 font-semibold"
                                    >Catatan / Notes</label
                                >
                                <textarea
                                    class="drop-shadow-sm border py-2 px-3 rounded-md focus:outline-none text-sm"
                                    v-model="cutiForm.keterangan_cuti"
                                    name=""
                                    id=""
                                    cols="5"
                                    rows="5"
                                ></textarea>

                                <div
                                    class="text-xs px-1 text-red-600"
                                    v-if="errors.fileData"
                                >
                                    {{ errors.fileData }}
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
            <div
                class="w-3/6 bg-white h-full my-auto drop-shadow-lg overflow-x-auto"
            >
                <div class="p-4 flex flex-col justify-start gap-2">
                    <div class="flex justify-between gap-3">
                        <input
                            @keyup="searchKaryawan"
                            type="search"
                            class="drop-shadow-sm border py-1 px-3 rounded-md focus:outline-none text-sm w-full"
                            v-model="form.saerch_nama_karyawan"
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
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <td
                                colspan="5"
                                rowspan="7"
                                class="text-center py-20"
                                v-if="this.loading"
                            >
                                <div
                                    class="w-full flex justify-center"
                                    role="status"
                                >
                                    <svg
                                        aria-hidden="true"
                                        class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-slate-100 fill-blue-600"
                                        viewBox="0 0 100 101"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"
                                        />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"
                                        />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>

                            <td
                                v-else-if="this.dataKaryawan.length <= 0"
                                colspan="5"
                                class="text-center py-20"
                            >
                                <div class="mx-auto">Data Tidak Ditemukan</div>
                            </td>

                            <tr
                                v-else
                                v-for="(employee, index) in this.dataKaryawan"
                                class="hover:bg-gray-200"
                                @click="
                                    selectEmployee(
                                        employee.id,
                                        employee.nama_employee,
                                        employee.jabatan_employee
                                    )
                                "
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
import axios from "axios";

export default {
    data() {
        return {
            fileExcel: null,
            modal: false,
            nama_karyawan: "",
            jabatan_employee: "",
            dataKaryawan: [],
            loading: false,
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
        jenis_cuti: Object,
    },
    setup() {
        const form = useForm({
            saerch_nama_karyawan: "",
        });

        const cutiForm = useForm({
            id_jenis_cuti: 1,
            id_employee: null,
            tanggal_mulai_cuti: null,
            tanggal_akhir_cuti: null,
            keterangan_cuti: "Keterangan Cuti",
            jumlah_cuti: 0,
        });
        return { form, cutiForm };
    },

    methods: {
        formCutiKaryawan() {
            router.post("/hris/karyawan/cuti/create", this.cutiForm, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
        openModal() {
            this.modal = !this.modal;
            this.dataKaryawan = this.karyawan.data;
        },
        searchKaryawan() {
            clearTimeout();
            setTimeout(() => {
                // router.post("/hris/karyawan/cuti", this.form);
                this.loading = true;
                axios
                    .post("/hris/karyawan/cuti", this.form)
                    .then((response) => {
                        this.dataKaryawan = response.data.karyawan.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }, 1000);
        },
        selectEmployee(id, namaKaryawan, jabatanKaryawan) {
            this.modal = false;
            this.cutiForm.id_employee = id;
            this.nama_karyawan = namaKaryawan;
            this.jabatan_employee = jabatanKaryawan;
        },
        kalkulasiTanggal() {
            let tanggalMulaiCuti = new Date(this.cutiForm.tanggal_mulai_cuti);
            let tanggalAkhirCuti = new Date(this.cutiForm.tanggal_akhir_cuti);

            var time_difference =
                tanggalAkhirCuti.getTime() - tanggalMulaiCuti.getTime();

            //calculate days difference by dividing total milliseconds in a day
            var days_difference = time_difference / (1000 * 3600 * 24);

            this.cutiForm.jumlah_cuti = days_difference + 1;
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
