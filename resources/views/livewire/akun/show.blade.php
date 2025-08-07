<div>
    <x-page-title page-title="Detail Akun" page-pretitle="Menampilkan detail akun.">
        <x-backend.button.back name="Kembali" route="setting.akun.index" />
    </x-page-title>

    <x-backend.alert />

    <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <div class="card-body ">
            <ul class="list-group rounded-top-0">
                <li class="list-group-item border-bottom p-3 d-flex">
                    <div class="my-auto">
                        <h5>INFORMASI AKUN</h5>
                    </div>
                </li>
                <li class="list-group-item border-bottom p-3">
                    <div>
                        @if ($this->user->avatar)
                            <img src="{{ asset('storage/' . $this->user->avatar) }}" class="rounded-3" width="120"
                                height="120" alt="avatar">
                        @else
                            <img src="{{ asset('images/not-image-user.gif') }}" class="rounded-3" width="120"
                                height="120" alt="no-image">
                        @endif
                    </div>
                </li>
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="text-muted pe-4">Nama</div>
                        <h6 class=" mb-0 pb-0 mt-1">{{ $this->user->name }}</h6>
                    </div>
                </li>
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="text-muted pe-4">{{ $this->user->role == 'admin' ? 'Email' : 'No. Registrasi' }}
                        </div>
                        <h6 class="mb-0 pb-0 mt-1">
                            {{ $this->user->role == 'admin' ? $this->user->email : $this->user->number_registration }}
                        </h6>
                    </div>
                </li>
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="text-muted pe-4">Role</div>
                        <h6 class="mb-0 pb-0 mt-1">{{ $this->user->role == 'user' ? 'siswa' : 'admin' }}</h6>
                    </div>
                </li>
                <li class="list-group-item border-bottom p-3">
                    <div>
                        <div class="text-muted pe-4">Status Akun</div>
                        <h6
                            class="mb-0 fs-6 fw-normal pb-0 mt-1 {{ $this->user->is_active ? 'bg-success' : 'bg-dark' }} text-white d-inline-block px-2 py-1 pb-1 rounded-2">
                            {{ $this->user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </h6>
                    </div>
                </li>
            </ul>
        </div>

        @if ($this->user->role == 'user' && $this->student)
            <div class="card-body ">
                <ul class="list-group rounded-top-0">
                    <li class="list-group-item border-bottom p-3 d-flex">
                        <div class="my-auto">
                            <h5>INFORMASI SISWA</h5>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">Nama Lengkap</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->full_name }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">Nomor Ponsel</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->phone }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">Jenis Kelamin</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->gender }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">Agama</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->religion }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">NISN</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->nisn }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">NIK</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->nik }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">Kompetensi</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->competence }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">Tempat Lahir</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->place_birth }}</h6>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom p-3">
                        <div>
                            <div class="text-muted pe-4">Tanggal Lahir</div>
                            <h6 class=" mb-0 pb-0 mt-1">{{ $this->student->birth_day }}</h6>
                        </div>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</div>
