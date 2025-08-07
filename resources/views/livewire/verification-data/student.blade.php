<div>
    <x-page-title page-title="Verifikasi Siswa" page-pretitle="Menampilkan data verifikasi siswa.">
        <button class="btn btn-primary">Materi & Jadwal Ujian</button>
    </x-page-title>

    <x-backend.alert />

    <div class="filter-datatable d-flex flex-wrap">
        <x-datatable.search placeholder="Cari Siswa" />
        <x-datatable.button-advence target="siswa" />
        <x-datatable.items-per-page />
    </div>

    <x-datatable.filter-advence target="siswa">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <x-backend.form.input name="tanggalAwal" wire:model.live='filters.date_start' label="Tanggal Awal"
                        type="date" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-backend.form.input name="TanggalAkhir" wire:model.live='filters.date_end' label="Tanggal Akhir"
                        type="date" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-backend.form.input name="nisn" wire:model.live='filters.nisn' label="NISN"
                        placeholder="Masukkan NISN" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-backend.form.select name="verificationStudent" wire:model.live='filters.verification_student'
                        label="Status Verifikasi Siswa">
                        <option value="">- semua -</option>
                        @foreach (config('const.verification_student') as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </x-backend.form.select>
                </div>
            </div>
        </div>
    </x-datatable.filter-advence>

    <div class="table-responsive card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>
                        <x-datatable.column-sort name="No. Pendaftaran" wire:click="sortBy('number_registration')"
                            :direction="$sorts['number_registration'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="NISN" wire:click="sortBy('nisn')" :direction="$sorts['nisn'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="NIK" wire:click="sortBy('nik')" :direction="$sorts['nik'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Nama Lengkap" wire:click="sortBy('full_name')"
                            :direction="$sorts['full_name'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Status Verifikasi" wire:click="sortBy('verification_student')"
                            :direction="$sorts['verification_student'] ?? null" />
                    </th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->student->number_registration }}</td>
                        <td>{{ $item->student->nisn }}</td>
                        <td>{{ $item->student->nik }}</td>
                        <td>{{ $item->student->full_name }}</td>
                        <td>
                            <div
                                class="{{ $item->student->verification_student == 'Belum Diverifikasi' ? 'badge-danger' : 'badge-success' }}">
                                {{ $item->student->verification_student }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn btn-action btn-sm btn-default d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-print"></i></button>

                                <button wire:loading.delay.attr='disabled'
                                    wire:click="handleVerification({{ $item->id }})"
                                    class="btn btn-action btn-sm {{ $item->student->verification_student == 'Belum Diverifikasi' ? 'btn-info' : 'btn-danger' }} d-flex"><i
                                        class="m-auto fa-solid fs-xs {{ $item->student->verification_student == 'Belum Diverifikasi' ? 'fa-check' : 'fa-x' }}"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <x-datatable.empty colspan="7" />
                @endforelse

            </tbody>
        </table>
    </div>

</div>
