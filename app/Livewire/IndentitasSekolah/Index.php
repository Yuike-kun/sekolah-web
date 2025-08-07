<?php

namespace App\Livewire\IndentitasSekolah;

use App\Models\AppIdentitiy;
use App\Models\IdentitiySchool;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    #[Title('Indentitas Sekolah')]
    public $logoSekolah;

    public $kepalaSekolah;

    public $wakilSekolah;

    public $namaSekolah;

    public $jenjangSekolah;

    public $npsn;

    public $statusSekolah;

    public $provinsi;

    public $kabupaten;

    public $kecamatan;

    public $kelurahan;

    public $alamatSekolah;

    public $emailSekolah;

    public $nomorPonselSekolah;

    public $facebookSekolah;

    public $instagramSekolah;

    public $twitterSekolah;

    public $youtubeSekolah;

    public $LOGO;

    public function rules()
    {
        return [
            'logoSekolah' => ['nullable', 'image', 'max:2048'],
            'kepalaSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
            'wakilSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
            'namaSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
            'namaSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
            'jenjangSekolah' => ['nullable', 'string', 'min:2', 'max:255'],
            'npsn' => ['nullable', 'string', 'min:2', 'max:255'],
            'statusSekolah' => ['nullable', 'string', 'min:2', 'max:255'],

            'provinsi' => ['nullable', 'string', 'min:2', 'max:255'],
            'kabupaten' => ['nullable', 'string', 'min:2', 'max:255'],
            'kecamatan' => ['nullable', 'string', 'min:2', 'max:255'],
            'kelurahan' => ['nullable', 'string', 'min:2', 'max:255'],
            'alamatSekolah' => ['nullable', 'string', 'min:2', 'max:255'],

            'emailSekolah' => ['nullable', 'string', 'email'],
            'nomorPonselSekolah' => ['nullable', 'string'],
            'facebookSekolah' => ['nullable', 'string', 'max:255'],
            'instagramSekolah' => ['nullable', 'string', 'max:255'],
            'twitterSekolah' => ['nullable', 'string', 'max:255'],
            'youtubeSekolah' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function mount()
    {
        $school = IdentitiySchool::first();
        $app = AppIdentitiy::first();

        if ($school) {
            $this->provinsi = $school->province;
            $this->kabupaten = $school->regency;
            $this->kecamatan = $school->district;
            $this->kelurahan = $school->village;

            $this->namaSekolah = $school->name_school;
            $this->kepalaSekolah = $school->ladder_study;
            $this->wakilSekolah = $school->vice_pricipal;
            $this->statusSekolah = $school->status_school;
            $this->npsn = $school->npsn;
            $this->alamatSekolah = $school->location_study;
            $this->jenjangSekolah = $school->school_level;

            $this->LOGO = $school->logo;
        }

        if ($app) {
            $this->nomorPonselSekolah = $app->contact_school;
            $this->emailSekolah = $app->email_school;
            $this->facebookSekolah = $app->facebook_school;
            $this->instagramSekolah = $app->instagram_school;
            $this->twitterSekolah = $app->twitter_school;
            $this->youtubeSekolah = $app->youtube_school;
        }
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            $school = IdentitiySchool::updateOrCreate([
                'province' => $this->provinsi,
                'regency' => $this->kabupaten,
                'district' => $this->kecamatan,
                'village' => $this->kelurahan,
            ], [
                'name_school' => $this->namaSekolah,
                'ladder_study' => $this->kepalaSekolah,
                'vice_pricipal' => $this->wakilSekolah,
                'status_school' => $this->statusSekolah,
                'npsn' => $this->npsn,
                'location_study' => $this->alamatSekolah,
                'school_level' => $this->jenjangSekolah,
            ]);

            AppIdentitiy::updateOrCreate([
                'contact_school' => $this->nomorPonselSekolah,
                'email_school' => $this->emailSekolah,
            ], [
                'facebook_school' => $this->facebookSekolah,
                'youtube_school' => $this->youtubeSekolah,
                'instagram_school' => $this->instagramSekolah,
                'twitter_school' => $this->twitterSekolah,
            ]);

            if ($this->logoSekolah) {
                if ($school->logo) {
                    File::delete(public_path('storage/'.$school->logo));
                }

                $school->update(['logo' => $this->logoSekolah->store('/identity-school', 'public')]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => 'Identitas sekolah gagal disunting',
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => 'Identitas sekolah berhasil disunting',
        ]);
    }

    public function render()
    {
        return view('livewire.indentitas-sekolah.index', [
            'school' => IdentitiySchool::first(),
        ]);
    }
}
