<?php

namespace App\Livewire\RegistrationPpdb;

use App\Models\District;
use App\Models\IdentitiySchool;
use App\Models\PPDB;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentParent;
use App\Models\User;
use App\Models\Village;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class MultiStepRegistration extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Registrasi PPDB')]
    public $regencies = [];

    public $districts = [];

    public $villages = [];

    public $currStep = 1;

    public $namaLengkap;

    public $nisn;

    public $nik;

    public $jurusan;

    public $jenisKelamin;

    public $tempatLahir;

    public $tanggalLahir;

    public $agama;

    public $statusKeluarga;

    public $anakKe;

    public $jumlahSaudara;

    public $hobi;

    public $citaCita;

    public $paud;

    public $tamanKanakKanak;

    public $nomorPonselSiswa;

    public $jenisTempatTinggal;

    public $alamat;

    public $provinsi = null;

    public $kabupaten = null;

    public $kecamatan = null;

    public $kelurahan = null;

    public $kodePos;

    public $jarakSekolah;

    public $transportasi;

    public $nomorKK;

    public $namaKepalaKeluarga;

    public $namaAyah;

    public $nikAyah;

    public $tahunLahirAyah;

    public $statusAyah;

    public $pekerjaanAyah;

    public $penghasilanAyah;

    public $pendidikanAyah;

    public $namaIbu;

    public $nikIbu;

    public $tahunLahirIbu;

    public $statusIbu;

    public $pekerjaanIbu;

    public $penghasilanIbu;

    public $pendidikanIbu;

    public $namaWali;

    public $nikWali;

    public $tahunLahirWali;

    public $pekerjaanWali;

    public $penghasilanWali;

    public $pendidikanWali;

    public $nomorPonsel;

    public $nomorKKS;

    public $nomorPKH;

    public $nomorKIP;

    public $namaSekolah;

    public $jenjangSekolah;

    public $statusSekolah;

    public $npsnSekolah;

    public $lokasiSekolah;

    public $konfirmasi;

    public $statusActive = [
        'ayah' => false,
        'ibu' => false,
    ];

    public function updatedProvinsi($value)
    {
        $this->regencies = Regency::where('province_id', $value)->get();
    }

    public function updatedKabupaten($value)
    {
        $this->districts = District::where('regency_id', $value)->get();
    }

    public function updatedKecamatan($value)
    {
        $this->villages = Village::where('district_id', $value)->get();
    }

    // PERUBAHAN CHECK STATUS AYAH & IBU
    public function updatedStatusAyah($status)
    {
        if ($status == 'Sudah meninggal' || $status == 'Tidak diketahui') {
            $this->statusActive['ayah'] = false;
        } else {
            $this->statusActive['ayah'] = true;
        }
    }

    public function updatedStatusIbu($status)
    {
        if ($status == 'Sudah meninggal' || $status == 'Tidak diketahui') {
            $this->statusActive['ibu'] = false;
        } else {
            $this->statusActive['ibu'] = true;
        }
    }

    // NEXT STEP
    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currStep++;

        if ($this->currStep == 5) {
            $this->currStep = 5;
        }
    }

    // PREVIOUS STEP
    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currStep--;

        if ($this->currStep < 1) {
            $this->currStep = 1;
        }
    }

    public function validateData()
    {
        // STEP 1
        if ($this->currStep == 1) {
            $this->validate([
                'namaLengkap' => ['required', 'string', 'min:2', 'max:255'],
                'nisn' => ['required', 'string', 'between:5,20', 'unique:students,nisn'],
                'nik' => ['required', 'string', 'between:2,20', 'unique:students,nik'],
                'nomorPonselSiswa' => ['required', 'string', 'between:2,13'],
                'jurusan' => ['required', 'string', Rule::in(config('ppdb.jurusan'))],
                'jenisKelamin' => ['required', 'string', Rule::in(config('const.jenis_kelamin'))],
                'tempatLahir' => ['required', 'string', 'min:2', 'max:255'],
                'tanggalLahir' => ['required', 'string', 'min:2', 'max:255'],
                'agama' => ['required', 'string', Rule::in(config('ppdb.agama'))],
                'statusKeluarga' => ['required', 'string', Rule::in(config('ppdb.status_keluarga'))],
                'anakKe' => ['required', 'string', 'min:1', 'max:255'],
                'jumlahSaudara' => ['required', 'string', 'min:1', 'max:255'],
                'hobi' => ['required', 'string', Rule::in(config('ppdb.hobi'))],
                'citaCita' => ['required', 'string', Rule::in(config('ppdb.cita_cita'))],
                'paud' => ['required', 'string', Rule::in(config('ppdb.pernyataan'))],
                'tamanKanakKanak' => ['required', 'string', Rule::in(config('ppdb.pernyataan'))],
            ]);
        }

        // STEP 2
        if ($this->currStep == 2) {
            $this->validate([
                'jenisTempatTinggal' => ['required', 'string', Rule::in(config('ppdb.jns_tm_tinggal'))],
                'alamat' => ['required', 'string'],
                'provinsi' => ['required'],
                'kabupaten' => ['required'],
                'kecamatan' => ['required'],
                'kelurahan' => ['required'],
                'kodePos' => ['required', 'string', 'min:1'],
                'jarakSekolah' => ['required', 'string', Rule::in(config('ppdb.jarak'))],
                'transportasi' => ['required', 'string', Rule::in(config('ppdb.transportasi'))],
            ]);
        }

        // STEP 3
        if ($this->currStep == 3) {
            $this->validate([
                'nomorKK' => ['required', 'string', 'between:5,20', 'unique:student_parent,no_kk'],
                'namaKepalaKeluarga' => ['required', 'string', 'min:2', 'max:255'],

                'namaAyah' => ['required', 'string', 'min:2', 'max:255'],
                'nikAyah' => ['required', 'string', 'min:2', 'max:255'],
                'tahunLahirAyah' => ['required', 'string', 'min:2', 'max:255'],
                'statusAyah' => ['required', 'string', Rule::in(config('ppdb.status_hidup'))],

                'namaIbu' => ['required', 'string', 'min:2', 'max:255'],
                'nikIbu' => ['required', 'string', 'min:2', 'max:255'],
                'tahunLahirIbu' => ['required', 'string', 'min:2', 'max:255'],
                'statusIbu' => ['required', 'string', Rule::in(config('ppdb.status_hidup'))],

                'namaWali' => ['nullable', 'string', 'min:2', 'max:255'],
                'nikWali' => ['nullable', 'string', 'min:2', 'max:255'],
                'tahunLahirWali' => ['nullable', 'string', 'min:2', 'max:255'],
                'pekerjaanWali' => ['nullable', 'string', Rule::in(config('ppdb.pekerjaan'))],
                'penghasilanWali' => ['nullable', 'string', Rule::in(config('ppdb.penghasilan'))],
                'pendidikanWali' => ['nullable', 'string', Rule::in(config('ppdb.pendidikan'))],

                'nomorPonsel' => ['required', 'string', 'between:2,20'],

                'nomorKKS' => ['nullable', 'string', 'min:2', 'max:255'],
                'nomorPKH' => ['nullable', 'string', 'min:2', 'max:255'],
                'nomorKIP' => ['nullable', 'string', 'min:2', 'max:255'],
            ]);
        }

        // STEP 3 JIKA AYAH MASIH HIDUP
        if ($this->currStep == 3 && $this->statusActive['ayah']) {
            $this->validate([
                'pekerjaanAyah' => ['required', 'string', Rule::in(config('ppdb.pekerjaan'))],
                'penghasilanAyah' => ['required', 'string', Rule::in(config('ppdb.penghasilan'))],
                'pendidikanAyah' => ['required', 'string', Rule::in(config('ppdb.pendidikan'))],
            ]);
        }

        // STEP 3 JIKA IBU MASIH HIDUP
        if ($this->currStep == 3 && $this->statusActive['ibu']) {
            $this->validate([
                'pekerjaanIbu' => ['required', 'string', Rule::in(config('ppdb.pekerjaan'))],
                'penghasilanIbu' => ['required', 'string', Rule::in(config('ppdb.penghasilan'))],
                'pendidikanIbu' => ['required', 'string', Rule::in(config('ppdb.pendidikan'))],
            ]);
        }

        // STEP 4
        if ($this->currStep == 4) {
            $this->validate([
                'namaSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
                'jenjangSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
                'statusSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
                'npsnSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
                'lokasiSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
            ]);
        }

        // STEP 5 (CONFIRMATION DATA)
        if ($this->currStep == 5) {
            $this->validate([
                'konfirmasi' => ['required'],
            ]);
        }
    }

    public function save()
    {
        if (! $this->konfirmasi) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Data belum di konfirmasi!',
            ]);

            return back();
        }

        try {
            DB::beginTransaction();
            $student = Student::create([
                'number_registration' => number_registration(),
                'full_name' => $this->namaLengkap,
                'nisn' => $this->nisn,
                'nik' => $this->nik,
                'competence' => $this->jurusan,
                'gender' => $this->jenisKelamin,
                'place_birth' => $this->tempatLahir,
                'birth_day' => $this->tanggalLahir,
                'religion' => $this->agama,
                'family_status' => $this->statusKeluarga,
                'child_to' => $this->anakKe,
                'sum_sibling' => $this->jumlahSaudara,
                'hobby' => $this->hobi,
                'mind' => $this->citaCita,
                'paud' => $this->paud,
                'tk' => $this->tamanKanakKanak,
                'phone' => $this->nomorPonselSiswa,
            ]);

            $studentAddress = StudentAddress::create([
                'residence_type' => $this->jenisTempatTinggal,
                'address' => $this->alamat,
                'province_id' => $this->provinsi,
                'regency_id' => $this->kabupaten,
                'district_id' => $this->kecamatan,
                'village_id' => $this->kelurahan,
                'postal_code' => $this->kodePos,
                'distance' => $this->jarakSekolah,
                'transportation' => $this->transportasi,
            ]);

            $studentParent = StudentParent::create([
                'no_kk' => $this->nomorKK,
                'family_leader' => $this->namaKepalaKeluarga,

                'father' => $this->namaAyah,
                'nik_father' => $this->nikAyah,
                'birth_year_father' => $this->tahunLahirAyah,
                'status_father' => $this->statusAyah,
                'father_work' => $this->pekerjaanAyah,
                'father_income' => $this->penghasilanAyah,
                'education_father' => $this->pendidikanAyah,

                'mother' => $this->namaIbu,
                'nik_mother' => $this->nikIbu,
                'birth_year_mother' => $this->tahunLahirIbu,
                'status_mother' => $this->statusIbu,
                'mother_work' => $this->pekerjaanIbu,
                'mother_income' => $this->penghasilanIbu,
                'education_mother' => $this->pendidikanIbu,

                'guardian' => $this->namaWali,
                'nik_guardian' => $this->nikWali,
                'birth_year_guardian' => $this->tahunLahirWali,
                'guardian_work' => $this->pekerjaanWali,
                'guardian_income' => $this->penghasilanWali,
                'education_guardian' => $this->pendidikanWali,

                'kks' => $this->nomorKKS,
                'pkh' => $this->nomorPKH,
                'kip' => $this->nomorKIP,
                'phone' => $this->nomorPonsel,
            ]);

            $identitySchool = IdentitiySchool::create([
                'name_school' => $this->namaSekolah,
                'ladder_study' => $this->jenjangSekolah,
                'status_school' => $this->statusSekolah,
                'npsn' => $this->npsnSekolah,
                'location_study' => $this->lokasiSekolah,
            ]);

            $ppdb = PPDB::create([
                'number_registration' => $student->number_registration,
                'student_id' => $student->id,
                'student_address_id' => $studentAddress->id,
                'student_parent_id' => $studentParent->id,
                'identitiy_school_id' => $identitySchool->id,
            ]);

            if ($ppdb) {
                $user = User::create([
                    'ppdb_id' => $ppdb->id,
                    'name' => $student->full_name,
                    'number_registration' => $student->number_registration,
                    'role' => 'user',
                    'password' => bcrypt($student->nisn),
                ]);
            }

            Auth::login($user);

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Registrasi Calon Siswa Gagal.',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Regisrasi Calon Siswa Berhasil. Silahkan Cek Data Kembali.',
        ]);

        return redirect()->route('dashboard.index');
    }

    public function render()
    {
        return view('livewire.registration-ppdb.multi-step-registration', [
            'provinces' => Province::all('id', 'name'),
        ]);
    }
}
