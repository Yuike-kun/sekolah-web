<div>
    <x-page-title pagePretitle="Sunting Tujuan" pageTitle="Menyunting Tujuan">
        <x-backend.button.back name="Kembali" route="menu-profil.tujuan.index" />
    </x-page-title>

    <x-backend.alert />

    <form wire:submit="save" id="data">
        <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
            <div class="card-header d-flex">
                <h5 class="my-auto py-2">Sunting Tujuan</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="col-12">
                        <x-backend.form.input wire:model.lazy="gambar" name="gambar" type="file" label="Gambar"/>
                    </div>
                    <div class="col-12">
                        <div wire:ignore>
                            <x-backend.form.textarea data-note="{{ $note }}" class="w-100 notes" id="note"
                                rows="20" name="note" wire:model.defer="note" label="Deskripsi"/>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer text-end">
                <x-backend.button.save target="save" />
            </div>
        </div>
    </form>
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
                        ['font', 'fontSize', 'formatBlock'],
                        ['paragraphStyle', 'blockquote'],
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
