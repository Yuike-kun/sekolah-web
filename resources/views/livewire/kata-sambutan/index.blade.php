<div>
    <x-page-title page-title="kata sambutan" page-pretitle="Menampilkan Kata Sambutan." />

    <x-backend.alert />

    <div class="card rounded-1" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        @if (isset($profil->title_foreword) && isset($profil->foreword))

            <div class="card-body d-lg-flex my-5 mx-4 card-img-top">
                <div class="mx-lg-5 align-self-center mb-3">
                    @if (isset($profil->image_04))
                        <img src="{{ asset('storage/' . $profil->image_04) }}" alt="photo" width="200" height="200">
                    @else
                        <img src="{{ asset('backend/assets/images/NoImage.png') }}" alt="photo" width="200"
                            height="200">
                    @endif
                </div>
                <div class="mx-lg-5">
                    <h3 class="text-black">{{ $profil->title_foreword ?? 'Nama Pemberi Sambutan' }}</h3>
                    <p class="text-black">{{ $profil->foreword ?? 'Keterangan anda...' }}</p>
                </div>
            </div>

        @else
            <div class="d-flex">
                <h5 class="m-auto text-muted p-5"><i class="fa-solid fa-folder-open"></i> Data Tidak Ada</h5>
            </div>
        @endif
        <div class="card-footer d-flex">
            <div class="d-flex gap-2 ms-auto">
                <button wire.loading.attr='disabled' wire.target='destroy' class="btn btn-white" type="button"
                    wire:click="destroy">Kosongkan</button>
                <a class="btn btn-success ms-auto" href="{{ route('kata-sambutan.create') }}">
                    Edit Kata Sambutan
                </a>
            </div>
        </div>
    </div>
</div>
