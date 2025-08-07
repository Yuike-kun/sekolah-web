<div>
    <x-page-title page-title="Slide Show" page-pretitle="Menampilkan data slide show.">
        <button data-animation="fadeInUp" data-bs-toggle="modal" data-bs-target="#example-slide-show-modal"
            class="btn btn-primary">Tambah
            Slide Show</button>
    </x-page-title>

    <x-backend.alert />

    <div class="filter-datatable d-flex flex-wrap gap-2">
        <x-datatable.search placeholder="Cari Slide Show" />
        <x-datatable.items-per-page />
    </div>

    <div class="table-responsive card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px">No</th>
                    <th>Gambar</th>
                    <th>
                        <x-datatable.column-sort name="Judul" wire:click="sortBy('heading')" :direction="$sorts['heading'] ?? null" />
                    </th>
                    <th>
                        <x-datatable.column-sort name="Deskripsi" wire:click="sortBy('description')"
                            :direction="$sorts['description'] ?? null" />
                    </th>
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
                        <td>{{ $item->description }}</td>
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
                                <button data-bs-toggle="modal" data-bs-target="#example-edit-slide-show-modal"
                                    wire:loading.attr='disabled' wire:target='editSlideShow'
                                    wire:click='editSlideShow({{ $item->id }})'
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

    <x-backend.modal target="slide-show">

        <div class="text-center mb-5">
            <h5 class="text-dark">Tambah Slide Show</h5>
        </div>

        <div class="form-group">
            <form wire:submit='save'>
                <div class="row">
                    <div class="col-12">
                        <x-backend.form.input label="Gambar" name="gambarSlideShow"
                            placeholder="Masukkan Gambar Slide Show" type='file' wire:model.lazy='gambarSlideShow' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.input label="Judul" name="judulSlideShow" placeholder="Masukkan Judul"
                            wire:model.defer='judulSlideShow' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.input label="Deskripsi" name="deskripsiSlideShow"
                            placeholder="Masukkan Deskripsi" wire:model.defer='deskripsiSlideShow' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.switch label="Status" name="statusSlideShow" wire:model.defer='statusSlideShow'
                            checked="{{ $this->statusSlideShow }}" />
                    </div>
                    <div class="col-12 d-flex">
                        <x-backend.button.save click='save' class="ms-auto btn-success" name="Tambah"
                            target='save' />
                    </div>
                </div>
            </form>
        </div>
    </x-backend.modal>

    <x-backend.modal target="edit-slide-show">

        <div class="text-center mb-5">
            <h5 class="text-dark">Sunting Slide Show</h5>
        </div>

        <div class="form-group">
            <form wire:submit='updateSlideShow'>
                <div class="row">
                    <div class="col-12">
                        <x-backend.form.input label="Gambar" name="gambarSlideShow"
                            placeholder="Masukkan Gambar Slide Show" type='file' wire:model.lazy='gambarSlideShow' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.input label="Judul" name="judulSlideShow" placeholder="Masukkan Judul"
                            wire:model.defer='judulSlideShow' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.input label="Deskripsi" name="deskripsiSlideShow"
                            placeholder="Masukkan Deskripsi" wire:model.defer='deskripsiSlideShow' />
                    </div>
                    <div class="col-12">
                        <x-backend.form.switch label="Status" name="statusSlideShow"
                            wire:model.defer='statusSlideShow' checked="{{ $this->statusSlideShow }}" />
                    </div>
                    <div class="col-12 d-flex">
                        <x-backend.button.save click='updateSlideShow' class="ms-auto btn-success" name="Edit"
                            target='updateSlideShow' />
                    </div>
                </div>
            </form>
        </div>

    </x-backend.modal>

</div>

@section('script')
    <script>
        window.addEventListener('close-modal', e => {
            $('#example-edit-slide-show-modal').modal('hide');
            $('#example-slide-show-modal').modal('hide');
        });
    </script>
@endsection
