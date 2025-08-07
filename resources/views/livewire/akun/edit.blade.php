<div>
    <x-page-title pagePretitle="Sunting Akun" pageTitle="Menyunting Akun">
        <x-backend.button.back name="Kembali" route="setting.akun.index" />
    </x-page-title>

    <x-backend.alert />

    <div class="row">
        <div class="col-12">
            <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
                <form wire:submit.prevent="edit" id="data">
                    <div class="card-header d-flex">
                        <h5 class="my-auto py-2">Sunting Akun</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.input label='User Name' wire:model.defer="userName" name="userName"
                                        type="text" placeholder="Masukkan User Name Akun" />
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.input type='file' label='Foto' wire:model.defer="avatar"
                                        name="avatar" placeholder="Masukkan Foto Pengguna" />
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.select name="roleUser" wire:model.lazy="roleUser" label="Role">
                                        <option>- pilih -</option>
                                        @foreach (config('const.roles') as $role)
                                            <option wire:key='{{ $loop->index }}' value="{{ $role }}">
                                                {{ $role == 'admin' ? 'admin' : 'siswa' }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($this->roleUser)
                        @if ($this->roleUser == 'user')
                            <div class="card-body border-top">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.select name="pilihSiswa" wire:model.lazy="pilihSiswa"
                                            label="Status Pemilik Akun">
                                            <option>- pilih -</option>
                                            @foreach (config('const.verfication_account_student') as $choose)
                                                <option wire:key='{{ $loop->index }}' value="{{ $choose }}">
                                                    {{ $choose }}</option>
                                            @endforeach
                                        </x-backend.form.select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($this->roleUser == 'user')
                            @if ($this->pilihSiswa && $this->pilihSiswa == 'Pilih Siswa')
                                <div class="card-body border-top">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            @if (isset($students) && $students)
                                                <x-backend.form.select name="ppdbId" wire:model.lazy="ppdbId"
                                                    label="Siswa">
                                                    <option>- pilih -</option>
                                                    @foreach ($students as $student)
                                                        @if ($student->ppdb->akun == null)
                                                            <option wire:key='{{ $loop->index }}'
                                                                value="{{ $student->ppdb->id }}">
                                                                {{ $student->full_name }}</option>
                                                        @else
                                                            <option>- tidak ada siswa -</option>
                                                        @endif
                                                    @endforeach
                                                </x-backend.form.select>
                                            @else
                                                <p>Siswa Tidak Ada</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($this->pilihSiswa && $this->pilihSiswa == 'Tanpa Siswa')
                                <div class="card-body border-top">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <x-backend.form.input disabled label='No. Registrasi'
                                                wire:model.defer="nomorRegistrasiSiswa" name="nomorRegistrasiSiswa"
                                                type="text" placeholder="Masukkan Nomor Registrasi Siswa" />
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <x-backend.form.input
                                                confirm='kosongkan jika tidak ingin mengubah nisn / password siswa.'
                                                label='NISN' wire:model.defer="nisnSiswa" name="nisnSiswa"
                                                type="text" placeholder="Masukkan NISN siswa" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="card-body border-top">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input label='Email' wire:model.defer="userEmail"
                                            name="userEmail" type="text" placeholder="Masukkan Email User" />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input confirm='kosongkan jika tidak ingin mengubah password.'
                                            label='Password' wire:model.defer="password" name="password" type="password"
                                            placeholder="Masukkan Password" />
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <x-backend.form.input confirm='kosongkan jika tidak ingin mengubah password.'
                                            label='Konfirmasi Password' wire:model.defer="password_confirmation"
                                            name="password_confirmation" type="password"
                                            placeholder="Masukkan Konfirmasi Password" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="card-footer text-end">
                        <x-backend.button.save target="edit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
