<?php

namespace App\Livewire\Dashboard;

use App\Helpers\DashboardChart;
use App\Models\Profil;
use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('Dashboard')]
    public $verification;

    public $notVerification;

    public $registration;

    public $graduation;

    public $notGraduation;

    public $process;

    public $pendaftaran;

    public $lulus;

    public $tidakLulus;

    public function mount()
    {
        // VERIFICATION STUDENT | TERVERIFIKASI | BELUM DIVERIFIKASI
        $this->verification = Student::query()
            ->where('verification_student', 'Terverifikasi')
            ->whereYear('created_at', '>=', date('Y'))
            ->groupBy('verification_student')
            ->count();

        $this->notVerification = Student::query()
            ->where('verification_student', 'Belum Diverifikasi')
            ->whereYear('created_at', '>=', date('Y'))
            ->groupBy('verification_student')
            ->count();

        // REGISRATION | LULUS | PROSES | TIDAK LULUS
        $this->registration = Student::query()
            ->whereYear('created_at', '>=', date('Y'))
            ->groupBy('verification_student')
            ->count();

        $this->graduation = Student::query()
            ->where('verification_graduation', 'Lulus')
            ->whereYear('created_at', '>=', date('Y'))
            ->groupBy('verification_graduation')
            ->count();

        $this->process = Student::query()
            ->where('verification_graduation', 'Proses')
            ->whereYear('created_at', '>=', date('Y'))
            ->groupBy('verification_graduation')
            ->count();

        $this->notGraduation = Student::query()
            ->where('verification_graduation', 'Tidak Lulus')
            ->whereYear('created_at', '>=', date('Y'))
            ->groupBy('verification_graduation')
            ->count();

        // DATA CHART
        $this->lulus = DashboardChart::DataGraduation();
        $this->tidakLulus = DashboardChart::DataNotGraduation();
        $this->pendaftaran = DashboardChart::DataStudent();
    }

    public function get10RegistrationLatest()
    {
        $registrationLatest = Student::query()
            ->where('verification_student', 'Belum Diverifikasi')->get();

        return $registrationLatest;
    }

    public function toggleActivePPDB()
    {
        $profil = Profil::first();

        if (isset($profil)) {
            $profil->is_active_ppdb = $profil->is_active_ppdb == false ? true : false;
            $profil->save();
        } else {
            Profil::create(['is_active_ppdb' => true]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Status PPDB berhasil disunting!',
        ]);
    }

    public function handleVerification($id)
    {
        $student = Student::find($id);

        $student->verification_student = $student->verification_student == 'Belum Diverifikasi' ? 'Terverifikasi' : 'Belum Diverifikasi';

        if ($student->verification_student == 'Belum Diverifikasi') {
            $student->verification_graduation = 'Proses';
        }

        $student->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Verfikasi siswa berhasil di ubah!',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.index', [
            'registrations' => $this->get10RegistrationLatest(),
            'profil' => Profil::first(),
        ]);
    }
}
