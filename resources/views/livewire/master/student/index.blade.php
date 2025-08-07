<div>
    <x-page-title page-title="Data Siswa" page-pretitle="Menampilkan data siswa.">
        <x-backend.button.add name='Tambah Siswa' route='master.siswa.create' />
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
                    <x-backend.form.select name="gender" wire:model.live='filters.gender' label="Jenis Kelamin">
                        <option value="">- semua -</option>
                        @foreach (config('const.jenis_kelamin') as $gender)
                            <option value="{{ $gender }}">{{ $gender }}</option>
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
                        <x-datatable.column-sort name="Jenis Kelamin" wire:click="sortBy('gender')" :direction="$sorts['gender'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Tanggal Lahir" wire:click="sortBy('birth_day')"
                            :direction="$sorts['birh_day'] ?? null" />
                    </th>

                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->student->nisn }}</td>
                        <td>{{ $item->student->nik }}</td>
                        <td>{{ $item->student->full_name }}</td>
                        <td>{{ $item->student->gender }}</td>
                        <td>{{ $item->student->birth_day }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button wire:loading.attr='disabled' wire:target='destroy'
                                    wire:click='destroy({{ $item->id }})'
                                    class="btn btn-action btn-sm btn-danger d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-trash"></i></button>
                                <a href="{{ route('master.siswa.edit', $item->id) }}"
                                    class="btn btn-action btn-sm btn-info d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-pencil"></i></a>
                                <a href="{{ route('master.siswa.show', $item->id) }}"
                                    class="btn btn-action btn-sm btn-white d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-eye"></i></a>
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
