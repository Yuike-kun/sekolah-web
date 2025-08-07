<div>
    <x-page-title page-title="Kategori Berita" page-pretitle="Menampilkan data kategori berita.">
        <button data-animation="fadeInUp" data-bs-toggle="modal" data-bs-target="#example-kategori-berita-modal"
            class="btn btn-primary">Tambah
            Kategori Berita</button>
    </x-page-title>

    <x-backend.alert />

    <div class="filter-datatable d-flex flex-wrap gap-2">
        <x-datatable.search placeholder="Cari Kategori Berita" />
        <x-datatable.items-per-page />
    </div>

    <div class="table-responsive card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px">No</th>
                    <th>
                        <x-datatable.column-sort name="Kategori Berita" wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" />
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
                                <button data-bs-toggle="modal" data-bs-target="#example-edit-kategori-berita-modal"
                                    wire:loading.attr='disabled' wire:target='editCategory'
                                    wire:click='editCategory({{ $item->id }})'
                                    class="btn btn-action btn-sm btn-info d-flex"><i
                                        class="m-auto fa-solid fs-xs fa-pencil"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <x-datatable.empty colspan="7" />
                @endforelse

            </tbody>
        </table>
    </div>

    <x-backend.modal target="kategori-berita">

        <div class="text-center mb-5">
            <h5 class="text-dark">Tambah Kategori Berita</h5>
        </div>

        <div class="form-group">
            <form wire:submit='save'>
                <div class="row">
                    <div class="col-12">
                        <x-backend.form.input label="Nama Kategori" name="namaKategori"
                            placeholder="Masukkan Nama Kategori" wire:model.lazy='namaKategori' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.switch label="Status Kategori" name="statusKategori"
                            wire:model.lazy='statusKategori' checked="{{ $this->statusKategori }}" />
                    </div>
                    <div class="col-12 d-flex">
                        <x-backend.button.save click='save' class="ms-auto btn-success" name="Tambah"
                            target='save' />
                    </div>
                </div>
            </form>
        </div>
    </x-backend.modal>

    <x-backend.modal target="edit-kategori-berita">

        <div class="text-center mb-5">
            <h5 class="text-dark">Sunting Kategori Berita</h5>
        </div>

        <div class="form-group">
            <form wire:submit='updateCategory'>
                <div class="row">
                    <div class="col-12">
                        <x-backend.form.input label="Nama Kategori" name="namaKategori"
                            placeholder="Masukkan Nama Kategori" wire:model.lazy='namaKategori' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.switch label="Status Kategori" name="statusKategori"
                            wire:model.lazy='statusKategori' checked="{{ $this->statusKategori }}" />
                    </div>
                    <div class="col-12 d-flex">
                        <x-backend.button.save click='updateCategory' class="ms-auto btn-success" name="Edit"
                            target='updateCategory' />
                    </div>
                </div>
            </form>
        </div>

    </x-backend.modal>

</div>

@section('script')
    <script>
        window.addEventListener('close-modal', e => {
            $('#example-edit-kategori-berita-modal').modal('hide');
            $('#example-kategori-berita-modal').modal('hide');
        });
    </script>
@endsection
