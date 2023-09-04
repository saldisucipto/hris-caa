<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-4">
        <!-- Title Pages -->
        <title-pages> Manajemen Karyawan </title-pages>
        <!-- Endt Title Pages -->

        <!-- Main menu  -->
        <div
            class="grid grid-flow-row grid-cols-4 gap-5 mb-10 hape:flex hape:flex-col"
        >
            <!-- Card Master Data -->
            <card-master-data
                :linkTujuan="'data-karyawan'"
                :iconData="'fa-users'"
                >Data Karyawan</card-master-data
            >
            <card-master-data :linkTujuan="'cuti'" :iconData="'fa-pen'"
                >Cuti Karyawan</card-master-data
            >
            <card-master-data :linkTujuan="'mutasi'" :iconData="'fa-sync'"
                >Mutasi Karyawan</card-master-data
            >
            <!-- End Card Master Data -->
        </div>

        <!-- End Main Menu -->
    </div>
</template>

<script>
import Navigasi from "../../Widgets/Navigasi.vue";
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import TitlePages from "../../Widgets/TitlePages.vue";
import CardMasterData from "../../Widgets/CardMasterData.vue";

export default {
    components: {
        Navigasi,
        DashboardLayout,
        TitlePages,
        CardMasterData,
    },

    layout: DashboardLayout,
};
</script>

<style></style>
