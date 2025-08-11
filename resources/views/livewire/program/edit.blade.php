<div>
    <x-page-title pagePretitle="Edit Program" pageTitle="Menyunting Program">
        <x-backend.button.back name="Kembali" route="program.index" />
    </x-page-title>

    <x-backend.alert />

    <div class="row">
        <div class="col-12">
            <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
                <form wire:submit.prevent="save" id="data">
                    <div class="card-header d-flex">
                        <h5 class="my-auto py-2">Edit Program</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.input label='Nama Program' wire:model.defer="namaProgram"
                                        name="namaProgram" type="text" placeholder="masukkan nama program" />
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.input label='Informasi Program' wire:model.defer="informasiProgram"
                                        name="informasiProgram" type="text" placeholder="masukkan informasi program" />
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.input label='Gambar Program' wire:model.lazy="gambarProgram"
                                        name="gambarProgram" type="file" />
                                </div>
                                <div class="col-lg-6 col-12">
                                    <x-backend.form.switch label='Status Program' name="statusProgram"
                                        wire:model.defer='statusProgram' />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-backend.button.save target="save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>