<template>
    <div class="p-3 rounded-xl bg-white flex flex-col gap-2">
        <!-- Title Pages -->
        <title-pages> Buat Data Karyawan Baru </title-pages>
        <!-- Endt Title Pages -->

        <!-- Main menu  -->
        <div class="bg-slate-100 rounded-lg">
            <div class="p-3 flex flex-col">
                <div class="text-sm flex gap-1">
                    <i
                        class="fas fas fa-exclamation-circle text-yellow-400"
                    ></i>
                    <p class="font-semibold text-gray-800">
                        Pastikan Pengisian Data Sesuai !
                    </p>
                </div>

                <div>
                    <form
                        @submit.prevent="createFormEmployee"
                        class="p-5 flex flex-col w-full gap-8"
                    >
                        <div class="flex flex-col gap-10 text-sm">
                            <div class="flex w-full gap-2">
                                <div class="flex flex-col flex-1 gap-2">
                                    <label
                                        class="text-gray-700 font-semibold text-sm"
                                        >Nama Karyawan</label
                                    >
                                    <input
                                        type="text"
                                        class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        placeholder="Nama Karyawan"
                                        required
                                        autofocus
                                        v-model="form.nama_employee"
                                    />
                                    <div
                                        class="text-xs px-1 text-red-600"
                                        v-if="errors.nama_employee"
                                    >
                                        {{ errors.nama_employee }}
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-2">
                                    <label
                                        class="text-gray-700 font-semibold text-sm"
                                        >Pilih Perusahaan</label
                                    >
                                    <select
                                        v-model="form.id_company"
                                        name=""
                                        id=""
                                        class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                    >
                                        <option
                                            v-for="companyData in this.company"
                                            :value="companyData.id"
                                        >
                                            {{ companyData.nama_company }}
                                        </option>
                                    </select>

                                    <div
                                        class="text-xs px-1 text-red-600"
                                        v-if="errors.id_company"
                                    >
                                        {{ errors.id_company }}
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-2">
                                    <label
                                        class="text-gray-700 font-semibold text-sm"
                                        >Jabatan</label
                                    >
                                    <input
                                        type="text"
                                        class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        v-model="form.jabatan_employee"
                                        placeholder="Jabatan / Posisi Karyawan"
                                        required
                                    />
                                    <div
                                        class="text-xs px-1 text-red-600"
                                        v-if="errors.jabatan_employee"
                                    >
                                        {{ errors.jabatan_employee }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-full gap-2">
                                <div class="flex flex-col flex-1 gap-2">
                                    <label
                                        class="text-gray-700 font-semibold text-sm"
                                        >NIK KTP Karyawan</label
                                    >
                                    <input
                                        type="text"
                                        class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        placeholder="NIK KTP"
                                        required
                                        v-model="form.nik_employee"
                                    />
                                    <div
                                        class="text-xs px-1 text-red-600"
                                        v-if="errors.nik_employee"
                                    >
                                        {{ errors.nik_employee }}
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-2">
                                    <label
                                        class="text-gray-700 font-semibold text-sm"
                                        >NO Kartu Keluarga Karyawan</label
                                    >
                                    <input
                                        type="text"
                                        class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        placeholder="No Kartu Keluarga"
                                        required
                                        v-model="form.no_kk_employee"
                                    />
                                    <div
                                        class="text-xs px-1 text-red-600"
                                        v-if="errors.no_kk_employee"
                                    >
                                        {{ errors.no_kk_employee }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 grid-flow-col gap-2">
                                <div
                                    class="col-span-6 flex flex-col flex-1 gap-2"
                                >
                                    <label
                                        class="text-gray-700 font-semibold text-sm"
                                        >Alamat Karyawan</label
                                    >
                                    <input
                                        type="text"
                                        class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        placeholder="Jl. Maju Bukan Mundur"
                                        required
                                        v-model="form.alamat_employee"
                                    />
                                    <div
                                        class="text-xs px-1 text-red-600"
                                        v-if="errors.alamat_employee"
                                    >
                                        {{ errors.alamat_employee }}
                                    </div>
                                </div>
                                <div
                                    class="col-span-6 grid grid-flow-col grid-cols-6 gap-3"
                                >
                                    <div class="col-span-2 gap-1">
                                        <div class="flex flex-col gap-2">
                                            <label
                                                class="text-gray-700 font-semibold text-sm"
                                                >RT</label
                                            >
                                            <input
                                                type="text"
                                                class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                                placeholder="RT"
                                                maxlength="3"
                                                required
                                                v-model="
                                                    form.alamat_rt_employee
                                                "
                                            />
                                            <div
                                                class="text-xs px-1 text-red-600"
                                                v-if="errors.alamat_rt_employee"
                                            >
                                                {{ errors.alamat_rt_employee }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 gap-1">
                                        <div class="flex flex-col gap-2">
                                            <label
                                                class="text-gray-700 font-semibold text-sm"
                                                >RW</label
                                            >
                                            <input
                                                type="text"
                                                class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                                placeholder="RW"
                                                maxlength="3"
                                                required
                                                v-model="
                                                    form.alamat_rw_employee
                                                "
                                            />
                                            <div
                                                class="text-xs px-1 text-red-600"
                                                v-if="errors.alamat_rw_employee"
                                            >
                                                {{ errors.alamat_rw_employee }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 gap-1">
                                        <div class="flex flex-col gap-2">
                                            <label
                                                class="text-gray-700 font-semibold text-sm"
                                                >KODE POS</label
                                            >
                                            <input
                                                type="text"
                                                class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                                placeholder="KODE POS"
                                                maxlength="8"
                                                required
                                                v-model="
                                                    form.alamat_kode_pos_employee
                                                "
                                            />
                                            <div
                                                class="text-xs px-1 text-red-600"
                                                v-if="
                                                    errors.alamat_kode_pos_employee
                                                "
                                            >
                                                {{
                                                    errors.alamat_kode_pos_employee
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-flow-col grid-cols-8 gap-3">
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Kelurahan</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Kelurahan"
                                            required
                                            v-model="form.alamat_kel_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.alamat_kel_employee"
                                        >
                                            {{ errors.alamat_kel_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Kecamatan</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Kecamatan"
                                            required
                                            v-model="form.alamat_kec_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.alamat_kec_employee"
                                        >
                                            {{ errors.alamat_kec_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Kabupaten</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Kabupaten"
                                            required
                                            v-model="form.alamat_kab_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.alamat_kab_employee"
                                        >
                                            {{ errors.alamat_kab_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Provinsi</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Provinsi"
                                            required
                                            v-model="form.alamat_prov_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.alamat_prov_employee"
                                        >
                                            {{ errors.alamat_prov_employee }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-flow-col grid-cols-8 gap-3">
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Agama</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Agama"
                                            required
                                            v-model="form.agama_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.agama_employee"
                                        >
                                            {{ errors.agama_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Phone</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Phone"
                                            required
                                            maxlength="14"
                                            v-model="form.phone_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.phone_employee"
                                        >
                                            {{ errors.phone_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Email</label
                                        >
                                        <input
                                            type="email"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Email"
                                            required
                                            v-model="form.email_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.email_employee"
                                        >
                                            {{ errors.email_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-2">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Grade Karyawan</label
                                        >
                                        <select
                                            v-model="form.id_grade"
                                            name=""
                                            id=""
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        >
                                            <option
                                                v-for="gradeData in this.grade"
                                                :value="gradeData.id"
                                            >
                                                {{ gradeData.grade }}
                                            </option>
                                        </select>

                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.id_grade"
                                        >
                                            {{ errors.id_grade }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-flow-col grid-cols-6 gap-3">
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Jenis Kelamin</label
                                        >
                                        <select
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            v-model="
                                                form.jenis_kelamin_employee
                                            "
                                            id=""
                                        >
                                            <option value="laki-laki">
                                                Laki-Laki
                                            </option>
                                            <option value="perempuan">
                                                Perempuan
                                            </option>
                                        </select>

                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.jenis_kelamin_employee"
                                        >
                                            {{ errors.jenis_kelamin_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Tempat Lahir</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Tempat Lahir"
                                            required
                                            v-model="form.tempat_lahir_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.tempat_lahir_employee"
                                        >
                                            {{ errors.tempat_lahir_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Tanggal Lahir Karyawan</label
                                        >

                                        <input
                                            type="date"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Tanggal Lahir"
                                            required
                                            v-model="
                                                form.tanggal_lahir_employee
                                            "
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.tanggal_lahir_employee"
                                        >
                                            {{ errors.tanggal_lahir_employee }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-flow-col grid-cols-8 gap-3">
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >NIK Karyawan</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="NIK Karyawan - Kantor"
                                            required
                                            v-model="form.nik_karyawan_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.nik_karyawan_employee"
                                        >
                                            {{ errors.nik_karyawan_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-2">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Status Karyawan</label
                                        >
                                        <select
                                            name=""
                                            v-model="form.status_employee"
                                            id=""
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        >
                                            <option value="pkwt">PKWT</option>
                                            <option value="pkwtt">PKWTT</option>
                                        </select>

                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.status_employee"
                                        >
                                            {{ errors.status_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Kontrak Awal</label
                                        >
                                        <input
                                            type="DATE"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Kontrak Awal"
                                            required
                                            v-model="form.masa_kontrak_awal"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.masa_kontrak_awal"
                                        >
                                            {{ errors.masa_kontrak_awal }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Kontrak Akhir</label
                                        >
                                        <input
                                            type="DATE"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Kontrak aKHIR"
                                            required
                                            v-model="form.masa_kontrak_akhir"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.masa_kontrak_akhir"
                                        >
                                            {{ errors.masa_kontrak_akhir }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-flow-col grid-cols-8 gap-3">
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >No BPJS Kesehatan</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Nomer BPJS Kesehatan"
                                            required
                                            v-model="form.bpjs_ks_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.bpjs_ks_employee"
                                        >
                                            {{ errors.bpjs_ks_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >No BPJS Ketenagakerjaan</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Nomer BPJS Kesehatan"
                                            required
                                            v-model="form.bpjs_tk_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.bpjs_tk_employee"
                                        >
                                            {{ errors.bpjs_tk_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >NPWP</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Nomer BPJS Kesehatan"
                                            required
                                            v-model="form.npwp_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.npwp_employee"
                                        >
                                            {{ errors.npwp_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-2">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Bank</label
                                        >
                                        <select
                                            v-model="form.id_bank"
                                            name=""
                                            id=""
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        >
                                            <option
                                                v-for="bankData in this.bank"
                                                :value="bankData.id"
                                            >
                                                {{ bankData.Bank }}
                                            </option>
                                        </select>

                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.id_grade"
                                        >
                                            {{ errors.id_grade }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Bank Account</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Nomer Rekening"
                                            required
                                            v-model="form.bank_account_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.bank_account_employee"
                                        >
                                            {{ errors.bank_account_employee }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-flow-col grid-cols-8 gap-3">
                                <div class="col-span-2 gap-1">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Nama Ibu Kandung</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Nama Ibu Kandung"
                                            required
                                            v-model="form.nama_ibu_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.nama_ibu_employee"
                                        >
                                            {{ errors.nama_ibu_employee }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-2 gap-2">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Status Pernikahan</label
                                        >
                                        <select
                                            name=""
                                            v-model="
                                                form.status_pernikahan_employee
                                            "
                                            id=""
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                        >
                                            <option value="lajang">
                                                Lajang
                                            </option>
                                            <option value="menikah">
                                                Menikah
                                            </option>
                                        </select>

                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="
                                                errors.status_pernikahan_employee
                                            "
                                        >
                                            {{
                                                errors.status_pernikahan_employee
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-2">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Jumlah Anak</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Jumlah Anak"
                                            required
                                            v-model="form.jumlah_anak_employee"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.jumlah_anak_employee"
                                        >
                                            {{ errors.jumlah_anak_employee }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2 gap-2">
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="text-gray-700 font-semibold text-sm"
                                            >Pendidikan Terakhir</label
                                        >
                                        <input
                                            type="text"
                                            class="drop-shadow-sm px-3 py-1 border rounded-md focus:outline-none text-md"
                                            placeholder="Pendidikan Terakhir"
                                            required
                                            v-model="form.last_edu"
                                        />
                                        <div
                                            class="text-xs px-1 text-red-600"
                                            v-if="errors.last_edu"
                                        >
                                            {{ errors.last_edu }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            class="bg-blue-400 hover:bg-blue-700 text-white py-1 rounded-md drop-shadow-sm"
                            type="submit"
                        >
                            Buat Data
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
        return {};
    },
    components: {
        Navigasi,
        DashboardLayout,
        TitlePages,
        CardMasterData,
    },
    props: {
        errors: Object,
        company: Object,
        grade: Object,
        bank: Object,
    },
    setup() {
        const form = useForm({
            nama_employee: null,
            id_company: 1,
            jabatan_employee: null,
            nik_employee: null,
            no_kk_employee: null,
            alamat_employee: null,
            alamat_rt_employee: null,
            alamat_rw_employee: null,
            alamat_kode_pos_employee: null,
            alamat_kel_employee: null,
            alamat_kec_employee: null,
            alamat_kab_employee: null,
            alamat_prov_employee: null,
            agama_employee: null,
            phone_employee: null,
            email_employee: null,
            id_grade: 1,
            tanggal_masuk_employee: null,
            jenis_kelamin_employee: "laki-laki",
            tempat_lahir_employee: null,
            tanggal_lahir_employee: null,
            nik_karyawan_employee: null,
            status_employee: "pkwt",
            masa_kontrak_awal: null,
            masa_kontrak_akhir: null,
            bpjs_ks_employee: null,
            bpjs_tk_employee: null,
            npwp_employee: null,
            npwp_employee: null,
            id_bank: 1,
            bank_account_employee: null,
            nama_ibu_employee: null,
            jumlah_anak_employee: null,
            status_pernikahan_employee: "lajang",
        });
        return { form };
    },

    methods: {
        createFormEmployee() {
            this.form.tanggal_masuk_employee = this.form.masa_kontrak_awal;
            router.post("/hris/karyawan/buat-data-karyawan", this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
    },

    layout: DashboardLayout,
};
</script>

<style></style>
