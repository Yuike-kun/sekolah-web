<div>
    <x-page-title page-title="Profil Saya" page-pretitle="Menampilkan informasi tentang anda." />

    <x-backend.alert />

    <form wire:submit='save'>
        <div class="row mt-4">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 overflow-hidden" wire:loading.class.delay="card-loading"
                    wire:offline.class="card-loading">
                    <div class="card-body">
                        <div class="profile-avatar text-center">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle shadow"
                                    width="120" height="120" alt="user">
                            @else
                                <img src="{{ asset('backend/assets/images/NoImage.png') }}"
                                    class="rounded-circle shadow" width="120" height="120" alt="no_image">
                            @endif
                        </div>
                        <div class="text-center mt-4">
                            <h4 class="mb-1">{{ $user->name ?? 'Pengguna' }}</h4>
                            <p class="mb-0 text-secondary">{{ $user->role == 'admin' ? 'Admin' : 'Siswa' }}</p>
                            <div class="mt-4"></div>
                            <div class="form-group">
                                <x-backend.form.input wire:model.defer='avatar' name="avatar" type='file' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card-body" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">INFORMASI AKUN</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-lg-6 col-12 ">
                                    <x-backend.form.input wire:model.defer='userName' label='Username' name="userName"
                                        placeholder='userName' />
                                </div>
                                @if ($user->email)
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input wire:model.defer='userEmail' label='Email'
                                            name="userEmail" placeholder='Email' />
                                    </div>
                                @else
                                    <div class="col-lg-6 col-12 ">
                                        <x-backend.form.input readonly wire:model.defer='nomorRegistrasi'
                                            label='No. Registrasi' name="nomorRegistrasi"
                                            placeholder='No. Registrasi' />
                                    </div>
                                @endif
                                <div class="col-lg-6 col-12 ">
                                    <x-backend.form.input type='password' wire:model.defer='password'
                                        confirm='Kosongkan jika tidak ingin mengubah' label='Password' name="password"
                                        placeholder='Password' />
                                </div>
                                <div class="col-lg-6 col-12 ">
                                    <x-backend.form.input type='password' wire:model.defer='password_confirmation'
                                        confirm='Kosongkan jika tidak ingin mengubah' label='Konfirmasi Password'
                                        name="password_confirmation" placeholder='Konfirmasi Password' />
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <x-backend.button.save target='save' name='Simpan Perubahan' />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
