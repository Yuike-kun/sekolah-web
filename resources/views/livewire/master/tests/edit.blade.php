<div>
    <x-page-title page-title="Edit Ujian Tes" page-pretitle="Mengedit data ujian tes.">
        <x-backend.button.add name='Kembali' route='master.ujian.index' />
    </x-page-title>

    <x-backend.alert />

    <div class="card">
        <div class="card-body">
            <x-backend.form.textarea label='Soal' wire:model="question" name="question" placeholder="masukkan soal" />
            <x-backend.form.input type="number" label='Nilai' wire:model="points" name="points"
                placeholder="masukkan nilai" />
            <x-backend.form.select label='Tipe Soal' wire:model.live="type" name="type">
                <option value="" disabled> Pilih Tipe Soal </option>
                <option value="multiple_choice">Pilihan Ganda</option>
                <option value="essay">Essai</option>
            </x-backend.form.select>
            <div x-show="$wire.type == 'multiple_choice'">
                <x-backend.form.input type="number" label='Jumlah Pilihan' wire:model.live="count_option"
                    name="count_option" placeholder="masukkan jumlah pilihan" />
                @for ($i = 0; $i < $this->count_option; $i++)
                    <div class="mb-3">
                        <label class="form-label">Opsi {{ $i }}</label>
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping">
                                <input type="checkbox" wire:model.live="options.{{ $i }}.correct"
                                    name="options.{{ $i }}.correct" />
                            </span>
                            <input type="text" wire:model.live="options.{{ $i }}.label"
                                name="options.{{ $i }}.label" placeholder="masukkan label opsi"
                                class="form-control">
                        </div>
                    </div>
                @endfor
                <div class="alert alert-success" role="alert">
                    Centang untuk membuat opsi tersebut adalah opsi yang benar!
                </div>
            </div>
            <button class="btn btn-success" wire:click="save">
                Simpan
            </button>
        </div>
    </div>
</div>
