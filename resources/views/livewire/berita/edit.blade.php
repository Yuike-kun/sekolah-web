<div>
    <x-page-title pagePretitle="Sunting Berita" pageTitle="Menyunting Berita">
        <x-backend.button.back name="Kembali" route="menu-berita.index" />
    </x-page-title>

    <x-backend.alert />

    <div class="row">
        <div class="col-12">
            <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
                <form wire:submit.prevent="edit" id="data">
                    <div class="card-header d-flex">
                        <h5 class="my-auto py-2">Sunting Berita</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.input label='Judul Berita' wire:model.defer="judulBerita"
                                        name="judulBerita" type="text" placeholder="masukkan judul berita" />
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.input label='Gambar Berita' wire:model.lazy="gambarBerita"
                                        name="gambarBerita" type="file" />
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.select label='Kategori Berita' name='kategoriBerita'
                                        wire:model.defer='kategoriBerita'>
                                        <option>- pilih -</option>
                                        @foreach ($categories as $category)
                                            <option wire:key='{{ $loop->index }}' value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </x-backend.form.select>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.switch label='Status Berita' name="statusBerita"
                                        wire:model.defer='statusBerita' />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div wire:ignore>
                                        <x-backend.form.textarea data-note="{{ $note }}" class="w-100 notes"
                                            id="note" rows="20" name="note" wire:model.defer="note" label="Konten"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-backend.button.save target="edit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/css/suneditor.min.css') }}">
    <script src="{{ asset('backend/assets/dist/suneditor.min.js') }}"></script>
    <script>
        function load(note = null) {
            let items = document.querySelectorAll('.notes');
            let editor = {};

            Array.from(items).map((item) => {
                let note = item.getAttribute('data-note');
                item.value = note;
                let suneeditor = SUNEDITOR.create(item.getAttribute('id'), {
                    defaultStyle: "font-family :arial;font-size: 15px",
                    buttonList: [
                        ['undo', 'redo'],
                        ['bold'],
                        ['underline'],
                        ['italic'],
                        ['strike'],
                        ['subscript'],
                        ['superscript'],
                        ['fontColor', 'hiliteColor'],
                    ]
                });

                let name = item.getAttribute('name');
                editor[name] = suneeditor;
            })

            let button = document.querySelector('#data');

            if (button) {
                button.onclick = function() {
                    for (let key in editor) {
                        @this.note = editor[key].getContents();
                    }
                }
            }
        }

        load()
    </script>
@endsection
