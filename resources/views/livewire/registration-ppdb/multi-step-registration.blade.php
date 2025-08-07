<div class="container my-5">
    <div id="top-step" class="common-title align-title wow fadeInUp mb-5"
        style="visibility: visible; animation-name: fadeInUp;">
        <span>PPDB ONLINE</span>
        <h4 class="fw-bold">Penerimaan Peserta Didik Baru MTsQ Azhar Center Makassar <br> Tahun Ajaran 2023</h4>
    </div>

    <x-ppdb.progress-circle :curr-step="$currStep" />

    <x-frontend.alert />

    <form wire:submit='save'>
        @if ($currStep == 1)
            <x-ppdb.container-multi-step>
                <div class="card-header text-center form-header">
                    <h6 class="text-white mt-2">FORM ISIAN</h6>
                    <h5 class="fw-bold text-white">IDENTITAS DIRI CALON SISWA</h5>
                </div>

                <div class="card-body form-register-ppdb">
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="namaLengkap">Nama Lengkap<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="namaLengkap" wire:model.defer='namaLengkap'
                                        placeholder="Masukkan Nama Lengkap" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nisn">NISN<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nisn" wire:model.defer='nisn'
                                        placeholder="Masukkan NISN" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nik">NIK<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nik" wire:model.defer='nik'
                                        placeholder="Masukkan NIK" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="jurusan">Jurusan<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="jurusan" wire:model.defer='jurusan'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.jurusan') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2 mb-4">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="jenisKelamin">Jenis Kelamin<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <div class="d-flex gap-2">
                                        @foreach (config('const.jenis_kelamin') as $key => $item)
                                            <x-backend.form.check wire:model.defer='jenisKelamin'
                                                wire:key='{{ $key }}' name="jenisKelamin" type="radio"
                                                value="{{ $item }}" title="{{ $item }}" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="tempatLahir">Tempat Kelahiran<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="tempatLahir" wire:model.defer='tempatLahir'
                                        placeholder="Masukkan Tempat Kelahiran" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="tanggalLahir">Tanggal Lahir<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="tanggalLahir" type="date"
                                        wire:model.defer='tanggalLahir' placeholder="Masukkan Tanggal Lahir" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="agama">Agama<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="agama" wire:model.defer='agama'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.agama') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="statusKeluarga">Status Dalam Keluarga<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="statusKeluarga" wire:model.defer='statusKeluarga'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.status_keluarga') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="anakKe">Anak Ke<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="anakKe" wire:model.defer='anakKe' type="number"
                                        min="1" placeholder="Anak Ke" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="jumlahSaudara">Jumlah Saudara<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="jumlahSaudara" wire:model.defer='jumlahSaudara'
                                        type="number" min="1" placeholder="Masukkan Jumlah Saudara" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="hobi">Hobi<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="hobi" wire:model.defer='hobi'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.hobi') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="citaCita">Cita-Cita<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="citaCita" wire:model.defer='citaCita'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.cita_cita') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2 mb-4">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="paud">PAUD</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <div class="d-flex gap-2">
                                        @foreach (config('ppdb.pernyataan') as $key => $item)
                                            <x-backend.form.check wire:key='{{ $key }}'
                                                wire:model.defer='paud' name="paud" type="radio"
                                                value="{{ $item }}" title="{{ $item }}" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nomorPonselSiswa">Nomor Ponsel/Wa<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nomorPonselSiswa" wire:model.defer='nomorPonselSiswa'
                                        type="text" placeholder="Masukkan Nomor Ponsel/Wa" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2 mb-4">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="tamanKanakKanak">TK (Taman Kanak Kanak)</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <div class="d-flex gap-2">
                                        @foreach (config('ppdb.pernyataan') as $key => $item)
                                            <x-backend.form.check wire:key='{{ $key }}'
                                                wire:model.defer='tamanKanakKanak' name="tamanKanakKanak"
                                                type="radio" value="{{ $item }}"
                                                title="{{ $item }}" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ppdb.container-multi-step>
        @endif

        @if ($currStep == 2)
            <x-ppdb.container-multi-step>
                <div class="card-header text-center form-header">
                    <h6 class="text-white mt-2">FORM ISIAN</h6>
                    <h5 class="fw-bold text-white">ALAMAT CALON SISWA</h5>
                </div>
                <div class="card-body form-register-ppdb">
                    <div class="col-12">
                        <div class="row align-center">
                            <div class="col-lg-3 col-12 align-self-center">
                                <label for="jenisTempatTinggal">Jenis Tempat Tinggal<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-9 col-12">
                                <x-backend.form.select name="jenisTempatTinggal"
                                    wire:model.defer='jenisTempatTinggal'>
                                    <option selected>- pilih -</option>
                                    @foreach (config('ppdb.jns_tm_tinggal') as $key => $item)
                                        <option wire:key='{{ $key }}' value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </x-backend.form.select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row align-center">
                            <div class="col-lg-3 col-12 align-self-center">
                                <label for="alamat">Alamat<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-9 col-12">
                                <x-backend.form.input wire:model.defer.lazy='alamat' name="alamat"
                                    placeholder="Masukkan Alamat" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row align-center">
                            <div class="col-lg-3 col-12 align-self-center">
                                <label for="provinsi">Provinsi<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-9 col-12">
                                <x-backend.form.select name="provinsi" wire:model.defer.lazy='provinsi'>
                                    <option selected>- pilih -</option>
                                    @foreach ($provinces as $province)
                                        <option wire:key='provinsi-{{ $loop->index }}' value="{{ $province->id }}">
                                            {{ $province->name }}</option>
                                    @endforeach
                                </x-backend.form.select>
                            </div>
                        </div>
                    </div>

                    @if ($this->provinsi)
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="kabupaten">Kabupaten<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="kabupaten" wire:model.defer.lazy='kabupaten'>
                                        <option selected>- pilih -</option>
                                        @foreach ($this->regencies as $regency)
                                            <option wire:key='kabupaten-{{ $loop->index }}'
                                                value="{{ $regency->id }}">{{ $regency->name }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($this->kabupaten)
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="kecamatan">Kecamatan<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="kecamatan" wire:model.defer.lazy='kecamatan'>
                                        <option selected>- pilih -</option>
                                        @foreach ($this->districts as $district)
                                            <option wire:key='kecamatan-{{ $loop->index }}'
                                                value="{{ $district->id }}">{{ $district->name }}
                                            </option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($this->kecamatan)
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="kelurahan">Kelurahan<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="kelurahan" wire:model.defer.lazy='kelurahan'>
                                        <option selected>- pilih -</option>
                                        @foreach ($this->villages as $village)
                                            <option wire:key='kelurahan-{{ $loop->index }}'
                                                value="{{ $village->id }}">{{ $village->name }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="row align-center">
                            <div class="col-lg-3 col-12 align-self-center">
                                <label for="kodePos">Kode Pos<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-9 col-12">
                                <x-backend.form.input wire:model.defer.lazy='kodePos' name="kodePos"
                                    placeholder="Masukkan Kode Pos" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row align-center">
                            <div class="col-lg-3 col-12 align-self-center">
                                <label for="jarakSekolah">Jarak Ke Sekolah <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-9 col-12">
                                <x-backend.form.select name="jarakSekolah" wire:model.defer='jarakSekolah' required>
                                    <option selected>- pilih -</option>
                                    @foreach (config('ppdb.jarak') as $key => $item)
                                        <option wire:key='{{ $key }}' value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </x-backend.form.select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row align-center">
                            <div class="col-lg-3 col-12 align-self-center">
                                <label for="transportasi">Transportasi Yang Digunakan<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-9 col-12">
                                <x-backend.form.select name="transportasi" wire:model.defer='transportasi'>
                                    <option selected>- pilih -</option>
                                    @foreach (config('ppdb.transportasi') as $key => $item)
                                        <option wire:key='{{ $key }}' value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </x-backend.form.select>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ppdb.container-multi-step>
        @endif

        @if ($currStep == 3)
            <x-ppdb.container-multi-step>
                <div class="card-header text-center form-header">
                    <h6 class="text-white mt-2">FORM ISIAN</h6>
                    <h5 class="fw-bold text-white">ORANG TUA/WALI CALON SISWA</h5>
                </div>

                <div class="card-body form-register-ppdb">
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nomorKK">Nomor Kartu Keluarga<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nomorKK" wire:model.defer='nomorKK'
                                        placeholder="Masukkan Nomor Kartu Keluarga" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="namaKepalaKeluarga">Nama Kepala Keluarga<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="namaKepalaKeluarga"
                                        wire:model.defer='namaKepalaKeluarga'
                                        placeholder="Masukkan Nama Kepala Keluarga" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body form-register-ppdb border-top">
                    <h5 class="fw-bold text-center mb-4">DATA AYAH KANDUNG</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="namaAyah">Nama Ayah Kandung<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="namaAyah" wire:model.defer='namaAyah'
                                        placeholder="Masukkan Nama Ayah Kandung" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nikAyah">NIK Ayah<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nikAyah" wire:model.defer='nikAyah'
                                        placeholder="Masukkan NIK Ayah" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="tahunLahirAyah">Tahun Lahir Ayah<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="tahunLahirAyah" wire:model.defer='tahunLahirAyah'
                                        placeholder="Masukkan Tahun Lahir Ayah" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="statusAyah">Status Ayah<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="statusAyah" wire:model.lazy='statusAyah'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.status_hidup') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        @if ($statusActive['ayah'] == true)
                            <div class="col-12">
                                <div class="row align-center">
                                    <div class="col-lg-3 col-12 align-self-center">
                                        <label for="penghasilanAyah">Pekerjaan Ayah<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <x-backend.form.select name="pekerjaanAyah" wire:model.defer='pekerjaanAyah'>
                                            <option selected>- pilih -</option>
                                            @foreach (config('ppdb.pekerjaan') as $key => $item)
                                                <option wire:key='{{ $key }}' value="{{ $item }}">
                                                    {{ $item }}</option>
                                            @endforeach
                                        </x-backend.form.select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row align-center">
                                    <div class="col-lg-3 col-12 align-self-center">
                                        <label for="penghasilanAyah">Penghasilan Ayah<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <x-backend.form.select name="penghasilanAyah"
                                            wire:model.defer='penghasilanAyah'>
                                            <option selected>- pilih -</option>
                                            @foreach (config('ppdb.penghasilan') as $key => $item)
                                                <option wire:key='{{ $key }}' value="{{ $item }}">
                                                    {{ $item }}</option>
                                            @endforeach
                                        </x-backend.form.select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row align-center">
                                    <div class="col-lg-3 col-12 align-self-center">
                                        <label for="pendidikanAyah">Pendidikan Ayah<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <x-backend.form.select name="pendidikanAyah"
                                            wire:model.defer='pendidikanAyah'>
                                            <option selected>- pilih -</option>
                                            @foreach (config('ppdb.pendidikan') as $key => $item)
                                                <option wire:key='{{ $key }}' value="{{ $item }}">
                                                    {{ $item }}</option>
                                            @endforeach
                                        </x-backend.form.select>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body form-register-ppdb border-top">
                    <h5 class="fw-bold text-center mb-4">DATA IBU KANDUNG</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="namaIbu">Nama Ibu Kandung<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="namaIbu" wire:model.defer='namaIbu'
                                        placeholder="Masukkan Nama Ibu Kandung" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nikIbu">NIK Ibu<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nikIbu" wire:model.defer='nikIbu'
                                        placeholder="Masukkan NIK Ibu" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="tahunLahirIbu">Tahun Lahir Ibu<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="tahunLahirIbu" wire:model.defer='tahunLahirIbu'
                                        placeholder="Masukkan Tahun Lahir Ibu" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="statusIbu">Status Ibu<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="statusIbu" wire:model.lazy='statusIbu'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.status_hidup') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        @if ($statusActive['ibu'] == true)
                            <div class="col-12">
                                <div class="row align-center">
                                    <div class="col-lg-3 col-12 align-self-center">
                                        <label for="pekerjaanIbu">Pekerjaan Ibu<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <x-backend.form.select name="pekerjaanIbu" wire:model.defer='pekerjaanIbu'>
                                            <option selected>- pilih -</option>
                                            @foreach (config('ppdb.pekerjaan') as $key => $item)
                                                <option wire:key='{{ $key }}' value="{{ $item }}">
                                                    {{ $item }}</option>
                                            @endforeach
                                        </x-backend.form.select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row align-center">
                                    <div class="col-lg-3 col-12 align-self-center">
                                        <label for="penghasilanIbu">Penghasilan Ibu<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <x-backend.form.select name="penghasilanIbu"
                                            wire:model.defer='penghasilanIbu'>
                                            <option selected>- pilih -</option>
                                            @foreach (config('ppdb.penghasilan') as $key => $item)
                                                <option wire:key='{{ $key }}' value="{{ $item }}">
                                                    {{ $item }}</option>
                                            @endforeach
                                        </x-backend.form.select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row align-center">
                                    <div class="col-lg-3 col-12 align-self-center">
                                        <label for="pendidikanIbu">Pendidikan Ibu<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <x-backend.form.select name="pendidikanIbu" wire:model.defer='pendidikanIbu'>
                                            <option selected>- pilih -</option>
                                            @foreach (config('ppdb.pendidikan') as $key => $item)
                                                <option wire:key='{{ $key }}' value="{{ $item }}">
                                                    {{ $item }}</option>
                                            @endforeach
                                        </x-backend.form.select>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body form-register-ppdb border-top">
                    <h5 class="fw-bold text-center mb-4">DATA WALI</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="namaWali">Nama Wali Kandung<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="namaWali" wire:model.defer='namaWali'
                                        placeholder="Masukkan Nama Wali Kandung" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nikWali">NIK Wali<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nikWali" wire:model.defer='nikWali'
                                        placeholder="Masukkan NIK Wali" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="tahunLahirWali">Tahun Lahir Wali<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="tahunLahirWali" wire:model.defer='tahunLahirWali'
                                        placeholder="Masukkan Tahun Lahir Wali" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="pekerjaanWali">Pekerjaan Wali<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="pekerjaanWali" wire:model.defer='pekerjaanWali'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.pekerjaan') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="penghasilanWali">Penghasilan Wali<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="penghasilanWali" wire:model.defer='penghasilanWali'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.penghasilan') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="pendidikanWali">Pendidikan Wali<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="pendidikanWali" wire:model.defer='pendidikanWali'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.pendidikan') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 my-3">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nomorPonsel">Nomor Ponsel Orangtua/Wali<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nomorPonsel" wire:model.defer='nomorPonsel'
                                        placeholder="Masukkan Nomor Ponsel Orangtua/Wali" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body form-register-ppdb border-top">
                    <h5 class="fw-bold text-center mb-4">KEPEMILIKAN KARTU</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nomorKKS">Nomor Kartu Keluarga Sejahtera (KKS)<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nomorKKS" wire:model.defer='nomorKKS'
                                        placeholder="Masukkan Nomor KKS" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nomorPKH">Nomor Kartu Program Keluarga Harapan (PKH)<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nomorPKH" wire:model.defer='nomorPKH'
                                        placeholder="Masukkan Nomor PKH" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="nomorKIP">Nomor Kartu Indonesia Pintar (KIP)<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="nomorKIP" wire:model.defer='nomorKIP'
                                        placeholder="Masukkan Nomor KIP" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ppdb.container-multi-step>
        @endif

        @if ($currStep == 4)
            <x-ppdb.container-multi-step>
                <div class="card-header text-center form-header">
                    <h6 class="text-white mt-2">FORM ISIAN</h6>
                    <h5 class="fw-bold text-white">DATA SEKOLAH ASAL</h5>
                </div>

                <div class="card-body form-register-ppdb">
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="namaSekolah">Nama Sekolah<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="namaSekolah" wire:model.defer='namaSekolah'
                                        placeholder="Masukkan Nama Sekolah" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="jenjangSekolah">Jenjang Sekolah<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="jenjangSekolah" wire:model.defer='jenjangSekolah'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.jenjang_sekolah') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="statusSekolah">Status Sekolah<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="statusSekolah" wire:model.defer='statusSekolah'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.lokasi_sekolah') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="npsnSekolah">NPSN Sekolah<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.input name="npsnSekolah" wire:model.defer='npsnSekolah'
                                        placeholder="Masukkan NPSN Sekolah" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row align-center">
                                <div class="col-lg-3 col-12 align-self-center">
                                    <label for="lokasiSekolah">Lokasi Sekolah<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <x-backend.form.select name="lokasiSekolah" wire:model.defer='lokasiSekolah'>
                                        <option selected>- pilih -</option>
                                        @foreach (config('ppdb.lokasi_sekolah') as $key => $item)
                                            <option wire:key='{{ $key }}' value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ppdb.container-multi-step>
        @endif

        @if ($currStep == 5)
            <x-ppdb.container-multi-step>
                <div class="card-header text-center form-header">
                    <h6 class="text-white mt-2">KONFIRMASI</h6>
                    <h5 class="fw-bold text-white">DATA CALON SISWA</h5>
                </div>

                <div class="card-body form-register-ppdb mx-3">
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            <p>Proses pendaftaran PPDB Online MTsQ Azhar Center Makassar hampir selesai.
                                Silahkan periksa kembali data-data yang sudah anda masukkan.</p>
                        </div>
                        <div class="col-12">
                            <h5>Apakah data calon siswa sudah sesuai?</h5>
                            <x-backend.form.check name="konfirmasi" wire:model.defer='konfirmasi'
                                title="Ya, data sudah sesuai!" />
                        </div>
                    </div>
                </div>
            </x-ppdb.container-multi-step>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-10 col-12 d-flex justify-content-between gap-2">

                <div>
                    @if ($currStep > 1 && $currStep <= 5)
                        <x-frontend.button.prev target="decreaseStep" name="Sebelumnya" />
                    @endif
                </div>

                <div>
                    @if ($currStep >= 1 && $currStep < 5)
                        <x-frontend.button.next target="increaseStep" name="Berikutnya" />
                    @endif

                    @if ($currStep == 5)
                        <x-frontend.button.save target="save" name="Kirim" />
                    @endif
                </div>

            </div>
        </div>
    </form>
</div>
