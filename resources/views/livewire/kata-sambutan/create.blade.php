<div>
    <x-page-title pagePretitle="Sunting Kata Sambutan" pageTitle="Menyunting Kata Sambutan">
        <x-backend.button.back name="Kembali" route="kata-sambutan.index" />
    </x-page-title>

    <x-backend.alert />

    <div class="row">
        <div class="col-12">

            <form wire:submit.prevent="save">
                <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
                    <div class="card-header d-flex">
                        <h5 class="my-auto py-2">Sunting Kata Sambuntan</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <x-backend.form.input label='Gambar Sambutan' wire:model.lazy="gambar"
                                        name="gambar" type="file" />
                                </div>
                                <div class="col-12">
                                    <x-backend.form.input label='Nama Pemberi Sambutan' wire:model.defer="nama"
                                        name="nama" type="text" placeholder="masukkan nama" />
                                </div>
                                <div class="col-12">
                                    <x-backend.form.textarea label='Kata Sambutan' wire:model.defer="sambutan"
                                        class="form-control" name="sambutan" rows="7"
                                        placeholder="masukkan sambutan" />
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
    </div>
</div>
