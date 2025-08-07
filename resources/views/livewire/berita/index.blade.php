<div>
    <x-page-title page-title="Berita" page-pretitle="Menampilkan data berita.">
        <x-backend.button.add route="menu-berita.create" icon="plus" name="Tambah Berita" />
    </x-page-title>

    <x-backend.alert />

    <div class="filter-datatable d-flex flex-wrap">
        <x-datatable.search placeholder="Cari Berita" />
        <x-datatable.items-per-page />
    </div>

    <div class="table-responsive card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px">No</th>
                    <th>Gambar</th>
                    <th>
                        <x-datatable.column-sort name="Judul Berita" wire:click="sortBy('heading')" :direction="$sorts['heading'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Isi Berita" wire:click="sortBy('body')" :direction="$sorts['body'] ?? null" />
                    </th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="product-img-2"
                                    alt="product img">
                            @else
                                <img src="{{ asset('backend/assets/images/NoImage.png') }}" class="product-img-2"
                                    alt="product img">
                            @endif
                        </td>
                        <td>{{ $item->heading }}</td>
                        <td>{!! Str::limit($item->body, 20) !!}</td>
                        <td>{{ $item->kategori->name }}</td>
                        <td> <button wire:loading.attr='disabled' wire:target='changeStatus'
                                wire:click='changeStatus({{ $item->id }})'
                                class="btn {{ $item->is_active ? 'btn-success' : 'btn-white' }} btn-sm">{{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}<i
                                    class="fa-solid fa-repeat"></i></button></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button wire:loading.attr='disabled' wire:target='destroy'
                                    wire:click='destroy({{ $item->id }})'
                                    class="btn btn-action btn-sm btn-danger d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-trash"></i></button>
                                <a href="{{ route('menu-berita.edit', $item->id) }}"
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
