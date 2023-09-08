<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Http\Charts\VisitorCharts;
use Illuminate\Support\Facades\DB;
use App\Http\Utils\FileProcess;
use App\Imports\EmployeeImport;
use App\Models\Bank;
use App\Models\Company;
use App\Models\Cuti;
use App\Models\Employee;
use App\Models\Foto;
use App\Models\GradeEmployee;
use App\Models\JenisCuti;
use App\Models\JenisPeringatan;
use App\Models\MutasiKaryawan;
use App\Models\Peringatan;
use App\Models\Resign;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class HrisController extends Controller
{

    public function akhirPeringatan(date $date)
    {
        return date('Y-m-d', strtotime($date . ' + 6 months'));
    }
    // home function
    public function index(VisitorCharts $chart)
    {
        $company = DB::table('company')->count();
        $employee = DB::table('employee')->count();

        $peringatan = Peringatan::with(['jenisPeringatan', 'employee'])->get(['tanggal_peringatan', 'id_employee', 'id_jenis_peringatan']);
        // dd($peringatan);
        // Mengambil tanggal awal bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();

        // Mengambil tanggal akhir bulan ini
        $endOfMonth = Carbon::now()->endOfMonth();

        // Menjalankan query untuk mengambil daftar orang yang ulang tahun dalam 1 bulan ini
        $upcomingBirthdays = DB::table('employee')->orderBy('tanggal_lahir_employee', 'ASC')
            ->whereBetween(DB::raw('DATE_FORMAT(tanggal_lahir_employee, "%m-%d")'), [$startOfMonth->format('m-d'), $endOfMonth->format('m-d')])
            ->get(['nama_employee', 'tanggal_lahir_employee']);

        $today = now();
        $kontrak = Employee::where('status_employee', 'pkwt')->whereDate('masa_kontrak_akhir', '<=', $today)
            ->whereDate('masa_kontrak_akhir', '>', $today->subDays(30))
            ->get(['nama_employee', 'jabatan_employee', 'masa_kontrak_akhir']);


        return Inertia::render('Hris/Index', ['peringatan' => $peringatan, 'company' => $company, 'employee' => $employee, 'ulangTahun' => $upcomingBirthdays, 'kontrak' => $kontrak]);
    }

    // employee function
    public function karyawan()
    {
        return Inertia::render('Hris/Employee/Employee');
    }

    // buat data karyawan
    public function buatDataKaryawan(Request $create)
    {
        if ($create->isMethod('GET')) {
            $company = Company::get();
            $grade = GradeEmployee::get();
            $bank = Bank::get();
            return Inertia::render('Hris/Employee/CreateEmployee', ['company' => $company, 'grade' => $grade, 'bank' => $bank]);
        } elseif ($create->isMethod('POST')) {
            $create->validate([
                'nama_employee' => 'required|string|max:200',
                'id_company' => 'numeric',
                'jabatan_employee' => 'required|string',
                'nik_employee' => 'required|string',
                'no_kk_employee' => 'required|string',
                'alamat_employee' => 'required|string',
                'alamat_rt_employee' => 'required|string|max:3',
                'alamat_rw_employee' => 'required|string|max:3',
                'alamat_kode_pos_employee' => 'required|string|max:10',
                'alamat_kel_employee' => 'required|string',
                'alamat_kec_employee' => 'required|string',
                'alamat_prov_employee' => 'required|string',
                'agama_employee' => 'required|string',
                'phone_employee' => 'required|string',
                'email_employee' => 'required|string|email',
                'id_grade' => 'required|numeric',
                'tanggal_masuk_employee' => 'nullable|date',
                'jenis_kelamin_employee' => 'required|string',
                'tempat_lahir_employee' => 'required|string',
                'tanggal_lahir_employee' => 'required|date',
                'nik_karyawan_employee' => 'required|string',
                'status_employee' => 'required|string',
                'masa_kontrak_awal' => 'nullable|date',
                'masa_kontrak_akhir' => 'nullable|date',
                'bpjs_ks_employee' => 'nullable|string',
                'bpjs_tk_employee' => 'nullable|string',
                'npwp_employee' => 'nullable|string',
                'id_bank' => 'numeric'
            ]);
            $dataEmployee = $create->all();
            $employee = new Employee();

            $employee->nama_employee = $dataEmployee['nama_employee'];
            $employee->id_company = $dataEmployee['id_company'];
            $employee->jabatan_employee = $dataEmployee['jabatan_employee'];
            $employee->nik_employee = $dataEmployee['nik_employee'];
            $employee->no_kk_employee = $dataEmployee['no_kk_employee'];
            $employee->alamat_employee = $dataEmployee['alamat_employee'];
            $employee->alamat_rt_employee = $dataEmployee['alamat_rt_employee'];
            $employee->alamat_rw_employee = $dataEmployee['alamat_rw_employee'];
            $employee->alamat_kode_pos_employee = $dataEmployee['alamat_kode_pos_employee'];
            $employee->alamat_kel_employee = $dataEmployee['alamat_kel_employee'];
            $employee->alamat_kec_employee = $dataEmployee['alamat_kec_employee'];
            $employee->alamat_kab_employee = $dataEmployee['alamat_kab_employee'];
            $employee->alamat_prov_employee = $dataEmployee['alamat_prov_employee'];
            $employee->agama_employee = $dataEmployee['agama_employee'];
            $employee->phone_employee = $dataEmployee['phone_employee'];
            $employee->email_employee = $dataEmployee['email_employee'];
            $employee->id_grade = $dataEmployee['id_grade'];
            $employee->tanggal_masuk_employee = $dataEmployee['tanggal_masuk_employee'];
            $employee->jenis_kelamin_employee = $dataEmployee['jenis_kelamin_employee'];
            $employee->tempat_lahir_employee = $dataEmployee['tempat_lahir_employee'];
            $employee->tanggal_lahir_employee = $dataEmployee['tanggal_lahir_employee'];
            $employee->nik_karyawan_employee = $dataEmployee['nik_karyawan_employee'];
            $employee->status_employee = $dataEmployee['status_employee'];
            $employee->masa_kontrak_awal = $dataEmployee['masa_kontrak_awal'];
            $employee->masa_kontrak_akhir = $dataEmployee['masa_kontrak_akhir'];
            $employee->bpjs_ks_employee = $dataEmployee['bpjs_ks_employee'];
            $employee->bpjs_tk_employee = $dataEmployee['bpjs_tk_employee'];
            $employee->npwp_employee = $dataEmployee['npwp_employee'];
            $employee->id_bank = $dataEmployee['id_bank'];
            $employee->bank_account_employee = $dataEmployee['bank_account_employee'];
            $employee->nama_ibu_employee = $dataEmployee['nama_ibu_employee'];
            $employee->jumlah_anak_employee = $dataEmployee['jumlah_anak_employee'];
            $employee->status_pernikahan_employee = $dataEmployee['status_pernikahan_employee'];
            $employee->last_edu = $dataEmployee['last_edu'];
            $employee->save();
            return redirect('/hris/karyawan/data-karyawan')->with('message', 'Berhasil Input Data Karyawan' . $create->input('nama_employee'));
        }
    }

    // show employee managamente
    public function dataKaryawan(Request $request)
    {
        $filter = [
            'perusahaan' => $request->id_company ? $request->id_company : 1,
            'countDisplay' =>  $request->countData ? $request->countData : 15,
            'namaKaryawan' => $request->namaKaryawan ? $request->namaKaryawan : "",
        ];
        $karyawan = Employee::orderBy('tanggal_masuk_employee', 'ASC')->where('status_employee', '!=', 'resign')->where('nama_employee', 'like', "%" . $filter['namaKaryawan'] . "%")->where('id_company', $filter['perusahaan'])->with(['perusahaan'])->paginate($filter['countDisplay'])->withQueryString();
        return Inertia::render('Hris/Employee/EmployeeData', ['employee' => $karyawan, 'filter' => $filter]);
    }

    // import data karyawan
    public function importDataKaryawan(Request $request)
    {
        if ($request->isMethod('GET')) {
            return Inertia::render('Hris/Employee/ImportEmployee');
        } elseif ($request->isMethod('POST')) {
            $request->validate([
                'fileData' => 'required|mimes:csv,xls,xlsx'
            ]);
            $dokumen = new FileProcess($request->file('fileData'), 'importexcel', 'excel');
            Excel::import(new EmployeeImport, $request->file('fileData')->store('temp'));
            return redirect('/hris/karyawan/data-karyawan')->with('message', 'Berhasil Import Data');
        }
    }

    function changePicture(Request $request, $id = null)
    {
        $karyawan = Employee::find($id);
        $fotoUpload = new FileProcess($request->file('fileData'), Str::slug($karyawan->nama_employee), 'foto');
        $foto = new Foto();
        $fotoExisits = Foto::where('id_employee', $id)->first();

        if (!$fotoExisits) {
            $foto->id_employee = $karyawan->id;
            $foto->foto_profile = $fotoUpload->uploadFoto();
            $foto->save();
        } else {
            $updateFoto = Foto::find($fotoExisits->id);
            FileProcess::deleteFoto($updateFoto->foto_profile, 'foto');
            $updateFoto->foto_profile = $fotoUpload->uploadFoto();
            $updateFoto->update();
        }

        return redirect()->back()->with('message', 'Berhasil Update Foto');
    }

    // detail karyawan
    public function detailKaryawan($id = null)
    {
        $karyawan = Employee::with(['perusahaan', 'grade', 'bank', 'resign', 'foto'])->find($id);
        return Inertia::render('Hris/Employee/ShowEmployee', ['karyawan' => $karyawan]);
    }

    // delete karyawan
    public function deleteKaryawan(Request $request, $id = null)
    {
        $karyawan = Employee::findOrFail($id);
        if ($request->isMethod('GET')) {
            return Inertia::render('Hris/Employee/DeleteEmployee', ['karyawan' => $karyawan]);
        } elseif ($request->isMethod('DELETE')) {
            $karyawan->delete();
            return redirect('/hris/karyawan/data-karyawan')->with('message', 'Data Karyawan ' . $karyawan->nama_employee . ' Berhasil dihapus!');
        }
    }

    // update karyawan
    public function updateKaryawan(Request $update, $id = null)
    {
        $karyawan = Employee::find($id);
        if ($update->isMethod('GET')) {
            $company = Company::get();
            $grade = GradeEmployee::get();
            $bank = Bank::get();
            return Inertia::render('Hris/Employee/UpdateEmployee', ['karyawan' => $karyawan, 'company' => $company, 'grade' => $grade, 'bank' => $bank]);
        } elseif ($update->isMethod('POST')) {
            $update->validate([
                'nama_employee' => 'required|string|max:200',
                'id_company' => 'numeric',
                'jabatan_employee' => 'required|string',
                'nik_employee' => 'required|string',
                'no_kk_employee' => 'required|string',
                'alamat_employee' => 'required|string',
                'alamat_rt_employee' => 'required|string|max:3',
                'alamat_rw_employee' => 'required|string|max:3',
                'alamat_kode_pos_employee' => 'required|string|max:10',
                'alamat_kel_employee' => 'required|string',
                'alamat_kec_employee' => 'required|string',
                'alamat_prov_employee' => 'required|string',
                'agama_employee' => 'required|string',
                'phone_employee' => 'required|string',
                'email_employee' => 'required|string|email',
                'id_grade' => 'required|numeric',
                'tanggal_masuk_employee' => 'nullable|date',
                'jenis_kelamin_employee' => 'required|string',
                'tempat_lahir_employee' => 'nullable|string',
                'tanggal_lahir_employee' => 'required|date',
                'nik_karyawan_employee' => 'required|string',
                'status_employee' => 'required|string',
                'bpjs_ks_employee' => 'nullable|string',
                'bpjs_tk_employee' => 'nullable|string',
                'npwp_employee' => 'nullable|string',
                'id_bank' => 'numeric'
            ]);
            $dataEmployee = $update->all();

            $karyawan->nama_employee = $dataEmployee['nama_employee'];
            $karyawan->id_company = $dataEmployee['id_company'];
            $karyawan->jabatan_employee = $dataEmployee['jabatan_employee'];
            $karyawan->nik_employee = $dataEmployee['nik_employee'];
            $karyawan->no_kk_employee = $dataEmployee['no_kk_employee'];
            $karyawan->alamat_employee = $dataEmployee['alamat_employee'];
            $karyawan->alamat_rt_employee = $dataEmployee['alamat_rt_employee'];
            $karyawan->alamat_rw_employee = $dataEmployee['alamat_rw_employee'];
            $karyawan->alamat_kode_pos_employee = $dataEmployee['alamat_kode_pos_employee'];
            $karyawan->alamat_kel_employee = $dataEmployee['alamat_kel_employee'];
            $karyawan->alamat_kec_employee = $dataEmployee['alamat_kec_employee'];
            $karyawan->alamat_kab_employee = $dataEmployee['alamat_kab_employee'];
            $karyawan->alamat_prov_employee = $dataEmployee['alamat_prov_employee'];
            $karyawan->agama_employee = $dataEmployee['agama_employee'];
            $karyawan->phone_employee = $dataEmployee['phone_employee'];
            $karyawan->email_employee = $dataEmployee['email_employee'];
            $karyawan->id_grade = $dataEmployee['id_grade'];
            $karyawan->tanggal_masuk_employee = $dataEmployee['tanggal_masuk_employee'];
            $karyawan->jenis_kelamin_employee = $dataEmployee['jenis_kelamin_employee'];
            $karyawan->tempat_lahir_employee = $dataEmployee['tempat_lahir_employee'];
            $karyawan->tanggal_lahir_employee = $dataEmployee['tanggal_lahir_employee'];
            $karyawan->nik_karyawan_employee = $dataEmployee['nik_karyawan_employee'];
            $karyawan->status_employee = $dataEmployee['status_employee'];
            $karyawan->masa_kontrak_awal = $dataEmployee['masa_kontrak_awal'];
            $karyawan->masa_kontrak_akhir = $dataEmployee['masa_kontrak_akhir'];
            $karyawan->bpjs_ks_employee = $dataEmployee['bpjs_ks_employee'];
            $karyawan->bpjs_tk_employee = $dataEmployee['bpjs_tk_employee'];
            $karyawan->npwp_employee = $dataEmployee['npwp_employee'];
            $karyawan->id_bank = $dataEmployee['id_bank'];
            $karyawan->bank_account_employee = $dataEmployee['bank_account_employee'];
            $karyawan->nama_ibu_employee = $dataEmployee['nama_ibu_employee'];
            $karyawan->jumlah_anak_employee = $dataEmployee['jumlah_anak_employee'];
            $karyawan->status_pernikahan_employee = $dataEmployee['status_pernikahan_employee'];
            $karyawan->last_edu = $dataEmployee['last_edu'];
            $karyawan->update();
            return redirect('/hris/karyawan/data-karyawan')->with('message', 'Berhasil Update ' . $update->input('nama_employee'));
        }
    }

    function mutasiKaryawan(Request $request, $id = null)
    {
        $karyawan = Employee::find($id);
        $mutasiKaryawan = new MutasiKaryawan();
        $company = Company::get(['id', 'nama_company']);
        if ($request->isMethod('GET')) {
            return  Inertia::render('Hris/Mutasi/MutasiEmployee', ['karyawan' => $karyawan, 'company' => $company]);
        } elseif ($request->isMethod('POST')) {
            $request->validate([
                'tanggal_mutasi' => 'required|date',
                'id_company_tujuan' => 'required'
            ]);
            // dd($data = $request->all());
            $data = $request->all();

            $mutasiKaryawan->id_employee = $data['id_employee'];
            $mutasiKaryawan->tanggal_mutasi = $data['tanggal_mutasi'];
            $mutasiKaryawan->id_company_asal = $data['id_company_asal'];
            $mutasiKaryawan->id_company_tujuan = $data['id_company_tujuan'];
            $mutasiKaryawan->jabatan_awal = $karyawan->jabatan_employee;
            $mutasiKaryawan->jabatan_tujuan = $data['jabatan_tujuan'];
            $mutasiKaryawan->notes = $data['notes'];
            $mutasiKaryawan->save();
            $karyawan->id_company = $data['id_company_tujuan'];
            $karyawan->jabatan_employee = $data['jabatan_tujuan'];
            $karyawan->update();
            return redirect('/hris/karyawan/data-karyawan')->with('message', 'Berhasil Input Mutasi Karyawan ' . $request->input($karyawan->nama_employee));
        }
    }

    // mutasi data
    function mutasi(Request $request)
    {
        $filter = [
            'perusahaan' => $request->id_company ? $request->id_company : 1,
            'countDisplay' =>  $request->countData ? $request->countData : 15,
            'jabatanAwal' => $request->jabatanAwal ? $request->jabatanAwal : "",
        ];
        $mutasi = MutasiKaryawan::with(['employee', 'companyAsal', 'companyTujuan'])->where('jabatan_awal', 'like', "%" . $filter['jabatanAwal'] . "%")->paginate($filter['countDisplay'])->withQueryString();
        // dd($mutasi);
        return  Inertia::render('Hris/Mutasi/MutasiEmployeeData', ['mutasi' => $mutasi, 'filter' => $filter]);
    }

    function resign(Request $request)
    {
        $filter = [
            'perusahaan' => $request->id_company ? $request->id_company : 1,
            'countDisplay' =>  $request->countData ? $request->countData : 15,
            'namaKaryawan' => $request->namaKaryawan ? $request->namaKaryawan : "",
        ];
        $karyawan = Employee::orderBy('tanggal_masuk_employee', 'ASC')->where('status_employee', 'resign')->where('nama_employee', 'like', "%" . $filter['namaKaryawan'] . "%")->where('id_company', $filter['perusahaan'])->with(['perusahaan'])->paginate($filter['countDisplay'])->withQueryString();
        return Inertia::render('Hris/Resign/EmployeeData', ['employee' => $karyawan, 'filter' => $filter]);
    }


    // karyawan Resign
    function resignKaryawan(Request $request, $id = null)
    {
        $karyawan = Employee::find($id);
        if ($request->isMethod('get')) {
            return Inertia::render('Hris/Resign/EmployeeReesign', ['karyawan' => $karyawan]);
        } elseif ($request->isMethod('POST')) {
            $request->validate([
                'tanggal_resign' => 'required|date'
            ]);
            $data = $request->all();
            $resign = new Resign();
            $resign->id_employee = $data['id_employee'];
            $resign->tanggal_resign = $data['tanggal_resign'];
            $resign->notes = $data['notes'];
            $resign->save();

            $karyawan->status_employee = 'resign';
            $karyawan->update();
            return redirect('/hris/karyawan/data-karyawan')->with('message', 'Berhasil Tandai Karyawan Resign ' . $karyawan->nama_employee);
        }
    }

    // cuti karyawan
    function cuti(Request $request)
    {
        $filter = [
            'saerch_nama_karyawan' => $request->saerch_nama_karyawan ? $request->saerch_nama_karyawan : "",
            'countDisplay' =>  $request->countData ? $request->countData : 15,
        ];
        $data = Employee::with('cuti')->where('status_employee', '!=', 'resign')->where('nama_employee', 'like', "%" . $filter['saerch_nama_karyawan'] . "%")->paginate($filter['countDisplay'])->withQueryString();;
        $karyawan = Employee::where('status_employee', '!=', 'resign')->where('nama_employee', 'like', "%" . $filter['saerch_nama_karyawan'] . "%")->paginate(7)->withQueryString();;

        if ($request->isMethod('POST')) {
            return response()->json(['karyawan' => $karyawan], 200);
        } else {
            return Inertia::render('Hris/Cuti/EmployeeCutiData', ['data' => $data, 'filter' => $filter]);
        }
    }

    // create cuti
    function createCuti(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $request->validate([
                'id_employee' => 'required',
                'tanggal_mulai_cuti' => 'required|date',
                'tanggal_akhir_cuti' => 'required|date'
            ]);
            $cuti = new Cuti();
            $cuti->id_jenis_cuti = $data['id_jenis_cuti'];
            $cuti->id_employee = $data['id_employee'];
            $cuti->tanggal_mulai_cuti = $data['tanggal_mulai_cuti'];
            $cuti->tanggal_akhir_cuti = $data['tanggal_akhir_cuti'];
            $cuti->keterangan_cuti = $data['keterangan_cuti'];
            $cuti->jumlah_cuti = $data['jumlah_cuti'];
            $cuti->save();
            return redirect('/hris/karyawan/cuti/')->with('message', 'Berhasil Membuat Cuti Karyawan ');
        } else {
            $karyawan = Employee::where('status_employee', '!=', 'resign')->paginate(7);
            $jenis_cuti = JenisCuti::get(['id', 'jenis_cuti']);
            return Inertia::render('Hris/Cuti/CreateEmployeeCuti', ['karyawan' => $karyawan, 'jenis_cuti' => $jenis_cuti]);
        }
    }

    // input cuti bersama
    function createCutiBersama(Request $request)
    {
        if ($request->isMethod('GET')) {
            $jenis_cuti = JenisCuti::get(['id', 'jenis_cuti']);
            return Inertia::render('Hris/Cuti/CreateEmployeeCutiBersama', ['jenis_cuti' => $jenis_cuti]);
        } elseif ($request->isMethod('POST')) {
            $request->validate([
                'tanggal_mulai_cuti' => 'required|date',
                'tanggal_akhir_cuti' => 'required|date'
            ]);
            $data = $request->all();
            $karyawan = Employee::get();
            $cutiBersama = [];
            foreach ($karyawan as $index => $value) {
                $cutiBersama[] = [
                    'id_jenis_cuti' => $data['id_jenis_cuti'],
                    'id_employee' => $value->id,
                    'tanggal_mulai_cuti' => $data['tanggal_mulai_cuti'],
                    'tanggal_akhir_cuti' => $data['tanggal_akhir_cuti'],
                    'keterangan_cuti' => $data['keterangan_cuti'],
                    'jumlah_cuti' => $data['jumlah_cuti'],
                ];
            }
            Cuti::insert($cutiBersama);
            return redirect('/hris/karyawan/cuti/')->with('message', 'Berhasil Membuat Cuti Bersama Karyawan ');
        }
    }

    // detail cuti
    function detailsCuti(Request $request, $id = null)
    {
        if ($request->isMethod('GET')) {
            $detailCuti = Employee::with(['cuti', 'foto'])->find($id);
            return Inertia::render('Hris/Cuti/EmployeeCutiDetails', ['data' => $detailCuti]);
        }
    }

    // surat peringat
    function suratPeringatan(Request $request)
    {
        if ($request->isMethod('GET')) {
            $filter = [
                'saerch_nama_karyawan' => $request->saerch_nama_karyawan ? $request->saerch_nama_karyawan : "",
                'countDisplay' =>  $request->countData ? $request->countData : 15,
            ];
            $data = Peringatan::with(['jenisPeringatan', 'employee'])->paginate($filter['countDisplay'])->withQueryString();;
            return Inertia::render('Hris/Peringatan/PeringatanData', ['data' => $data, 'filter' => $filter]);
        }
    }

    // create peringatan
    function createPringatan(Request $request)
    {
        $filter = [
            'saerch_nama_karyawan' => $request->saerch_nama_karyawan ? $request->saerch_nama_karyawan : "",
        ];
        $karyawan = Employee::where('status_employee', '!=', 'resign')->where('nama_employee', 'like', "%" . $filter['saerch_nama_karyawan'] . "%")->paginate(7);
        $jenis_peringatan = JenisPeringatan::get();
        if ($request->isMethod('GET')) {
            return Inertia::render('Hris/Peringatan/CreatePeringatan', ['karyawan' => $karyawan, 'jenis_peringatan' => $jenis_peringatan]);
        } elseif ($request->isMethod('POST')) {
            $data = $request->all();
            $request->validate([
                'tanggal_peringatan' => 'required|date',
                'id_employee' => 'required',
                'id_jenis_peringatan' => 'required',
            ]);
            $peringatan = new Peringatan();
            $peringatan->tanggal_peringatan = $data['tanggal_peringatan'];
            $peringatan->deskripsi_peringatan = $data['deskripsi_peringatan'];
            $peringatan->id_employee = $data['id_employee'];
            $peringatan->id_jenis_peringatan = $data['id_jenis_peringatan'];
            $peringatan->active = true;
            $peringatan->save();
            return redirect('/hris/karyawan/peringatan/')->with('message', 'Berhasil Membuat Peringatan Karyawan ');
        }
    }

    // delete peringatan
    function deletePeringatan($id)
    {
        $peringatan = Peringatan::find($id);
        $peringatan->delete();
        return redirect('/hris/karyawan/peringatan/')->with('message', 'Data Berhasil Dihapus');
    }
}
