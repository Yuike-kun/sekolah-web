<div>
    <x-page-title page-title="Data Akun" page-pretitle="Menampilkan data akun.">
        <x-backend.button.add name='Tambah Akun' route='setting.akun.create' icon='plus' />
    </x-page-title>

    <x-backend.alert />

    <div class="filter-datatable d-flex flex-wrap gap-2">
        <x-datatable.search placeholder="Cari Akun Pengguna" />
        <x-datatable.items-per-page />
    </div>

    <div class="table-responsive card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>
                        <x-datatable.column-sort name="Nama Pengguna" wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Email" wire:click="sortBy('email')" :direction="$sorts['email'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Nomor Registrasi" wire:click="sortBy('number_registration')"
                            :direction="$sorts['number_registration'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Peran Akun" wire:click="sortBy('role')" :direction="$sorts['role'] ?? null" />
                    </th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td>{{ $item->number_registration ?? '-' }}</td>
                        <td>
                            <div class="{{ $item->role == 'admin' ? 'badge-success' : 'badge-danger' }}">
                                {{ $item->role == 'admin' ? 'admin' : 'siswa' }}</div>
                        </td>
                        <td>
                            <button wire:loading.attr='disabled' wire:target='changeStatus'
                                wire:click='changeStatus({{ $item->id }})'
                                class="btn {{ $item->is_active ? 'btn-success' : 'btn-white' }} btn-sm">{{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}<i
                                    class="fa-solid fa-repeat"></i></button>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button wire:loading.attr='disabled' wire:target='destroy'
                                    wire:click='destroy({{ $item->id }})'
                                    class="btn btn-action btn-sm btn-danger d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-trash"></i></button>
                                <a href="{{ route('setting.akun.edit', $item->id) }}"
                                    class="btn btn-action btn-sm btn-info d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-pencil"></i></a>
                                <a href="{{ route('setting.akun.show', $item->id) }}"
                                    class="btn btn-sm btn-white d-flex"><i class="m-auto fa-solid fs-xs fa-eye"></i></a>
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
