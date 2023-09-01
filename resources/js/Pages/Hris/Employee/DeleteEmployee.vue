<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Main menu  -->
        <div class="bg-slate-100 rounded-lg">
            <div class="p-3 flex flex-col gap-3">
                <div class="text-sm flex gap-1">
                    <i class="fas fas fa-exclamation-circle text-red-400"></i>
                    <p class="font-semibold text-gray-800">
                        Data Dibawah ini akan dihapus !
                    </p>
                </div>
                <div class="text-sm flex gap-1">
                    <i class="fas fas fa-exclamation-circle text-blue-400"></i>
                    <p class="font-semibold text-gray-800">
                        Karyawan Resign / Mutasi? Tidak Perlu dihapus,
                        <a class="italic text-blue-700" href="#"
                            >Baca Petunjuk!</a
                        >
                    </p>
                </div>

                <div>
                    <form
                        @submit.prevent="deleteForm"
                        class="p-5 flex flex-col w-full gap-5"
                    >
                        <div class="flex flex-col gap-2">
                            <div class="font-semibold text-red-400">
                                {{ karyawan.nama_employee }} |
                                {{ karyawan.jabatan_employee }}
                            </div>
                        </div>

                        <button
                            class="bg-red-400 hover:bg-red-700 text-white py-1 rounded-md drop-shadow-sm w-32"
                            type="submit"
                        >
                            Hapus Data!
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
        deleteForm() {
            this.form.fileData = this.fileExcel;
            router.delete(
                "/hris/karyawan/delete-karyawan/" + this.karyawan.id,
                this.form,
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                    },
                }
            );
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
