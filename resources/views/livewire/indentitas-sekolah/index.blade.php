<div>
    <x-page-title page-title="Identitas Sekolah" page-pretitle="Menampilkan informasi tentang sekolah." />

    <x-backend.alert />

    <form wire:submit='save'>
        <div class="row mt-4">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 overflow-hidden" wire:loading.class.delay="card-loading"
                    wire:offline.class="card-loading">
                    <div class="card-body">
                        <div class="profile-avatar text-center">
                            @if (isset($school->logo))
                                <img src="{{ asset('storage/' . $school->logo) }}" class="rounded-circle shadow"
                                    width="120" height="120" alt="logo_sekolah">
                            @else
                                <img src="{{ asset('backend/assets/images/NoImage.png') }}"
                                    class="rounded-circle shadow" width="120" height="120" alt="no_image">
                            @endif
                        </div>
                        <div class="text-center mt-4">
                            <h4 class="mb-1">Logo {{ $namaSekolah ?? 'Sekolah' }}</h4>
                            <p class="mb-0 text-secondary">Indonesia, Makassar</p>
                            <div class="mt-4"></div>
                            <div class="form-group">
                                <x-backend.form.input wire:model.defer='logoSekolah' name="logoSekolah"
                                    type='file' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0" wire:loading.class.delay="card-loading"
                    wire:offline.class="card-loading">
                    <div class="card-body">
                        <h5 class="mb-0">Identitas Sekolah</h5>
                        <hr>
                        <div class="card shadow-none border">
                            <div class="card-header">
                                <h6 class="mb-0">INFORMASI SEKOLAH</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input wire:model.defer='kepalaSekolah'
                                            label='Kepala Sekolah / Kepala Yayasan' name="kepalaSekolah"
                                            placeholder='KepalaSekolah' />
                                    </div>
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input wire:model.defer='wakilSekolah'
                                            label='Wakil Sekolah / Wakil Yayasan' name="wakilSekolah"
                                            placeholder='wakilSekolah' />
                                    </div>
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input wire:model.defer='namaSekolah' label='Nama Sekolah'
                                            name="namaSekolah" placeholder='Nama Sekolah' />
                                    </div>
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input wire:model.defer='jenjangSekolah' label='Jenjang Sekolah'
                                            name="jenjangSekolah" placeholder='Jenjang Sekolah' />
                                    </div>
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input wire:model.defer='npsn' label='NPSN' name="npsn"
                                            placeholder='NPSN' />
                                    </div>
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input wire:model.defer='statusSekolah' label='Status Sekolah'
                                            name="statusSekolah" placeholder='Beroprasi / Tidak Beroprasi' />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-none border">
                            <div class="card-header">
                                <h6 class="mb-0">LOKASI SEKOLAH</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='provinsi' label='Provinsi'
                                            name="provinsiSekolah" placeholder='Provinsi' />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='kabupaten' label='Kab/Kota'
                                            name="kabupatenSekolah" placeholder='Kab/Kota' />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='kecamatan' label='Kecamatan'
                                            name="kecamatanSekolah" placeholder='Kecamatan' />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='kelurahan' label='Kelurahan'
                                            name="kelurahanSekolah" placeholder='Kelurahan' />
                                    </div>
                                    <div class="col-12">
                                        <x-backend.form.textarea wire:model.defer='alamatSekolah'
                                            label='Alamat Lengkap Sekolah' name='alamatSekolah' />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-none border" wire:loading.class.delay="card-loading"
                            wire:offline.class="card-loading">
                            <div class="card-header">
                                <h6 class="mb-0">KONTAK SEKOLAH</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='emailSekolah' label='Email'
                                            placeholder='Email' name='EmailSekolah' icon='envelope' />
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='nomorPonselSekolah'
                                            label='Nomor Ponsel/Wa' placeholder='Nomor Ponsel/Wa'
                                            name='nomorPonselSekolah' icon='phone' />
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='facebookSekolah' label='Facebook'
                                            placeholder='Facebook' name='facebookSekolah' brand='facebook' />
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='instagramSekolah' label='Instagram'
                                            placeholder='Instagram' name='instagramSekolah' brand='instagram' />
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='twitterSekolah' label='Twitter'
                                            placeholder='Twitter' name='twitterSekolah' brand='twitter' />
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input wire:model.defer='youtubeSekolah' label='Youtube'
                                            placeholder='Youtube' name='youtubeSekolah' brand='youtube' />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <x-backend.button.save target='save' name='Simpan Perubahan' />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
