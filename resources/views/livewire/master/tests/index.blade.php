<div>
    <x-page-title page-title="Data Ujian Tes" page-pretitle="Menampilkan data ujian tes.">
        <x-backend.button.add name='Tambah Soal' route='master.ujian.create' />
    </x-page-title>

    <x-backend.alert />

    <div class="filter-datatable d-flex flex-wrap">
        <x-datatable.search placeholder="Cari Soal" />
        {{-- <x-datatable.button-advence target="siswa" /> --}}
        <x-datatable.items-per-page />
    </div>

    <div class="table-responsive card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <table id="example" class="table table-bordered" style="width:100%; vertical-align: middle">
            <thead>
                <tr>
                    <th>
                        <x-datatable.column-sort name="Soal" wire:click="sortBy('question')" :direction="$sorts['question'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Tipe Soal" wire:click="sortBy('type')" :direction="$sorts['type'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Poin" wire:click="sortBy('points')" :direction="$sorts['points'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Status" wire:click="sortBy('is_active')" :direction="$sorts['is_active'] ?? null" />
                    </th>

                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr wire:key="{{ $loop->index }}">
                        <td>{{ $row->question }}</td>
                        <td>{{ str_replace('_', ' ', strtoupper($row->type)) }}</td>
                        <td>{{ $row->points }}</td>
                        <td>
                            {{ $row->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                            <button class="btn btn-sm btn-{{ $row->is_active == 1 ? 'danger' : 'success' }}"
                                wire:click="setStatus('{{ $row->id }}')" wire:loading.attr='disabled'>
                                <i class="fa-solid fs-xs fa-sync m-auto"></i>
                            </button>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button wire:loading.attr='disabled' wire:target='destroy'
                                    wire:click="destroy('{{ $row->id }}')"
                                    class="btn btn-action btn-sm btn-danger d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-trash"></i></button>
                                <a href="{{ route('master.ujian.edit', $row->id) }}"
                                    class="btn btn-action btn-sm btn-info d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-pencil"></i></a>
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
