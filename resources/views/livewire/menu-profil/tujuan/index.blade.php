<div>
    <x-page-title pagePretitle="Menampilkan Kata Tujuan" pageTitle="Kata Tujuan" />

    <x-backend.alert />

    <div class="card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
        @if (isset($profil->objective))
            <div class="card-body d-lg-flex my-5 mx-4 card-img-top">

                <div class="mx-lg-5 align-self-center mb-3">
                    @if (isset($profil->image_02))
                        <img src="{{ asset('storage/' . $profil->image_02) }}"  width="200" height="200">
                    @else
                        <img src="{{ asset('backend/assets/images/NoImage.png') }}"  width="200"
                            height="200">
                    @endif
                </div>
                <div class="mx-lg-5 overflow-hidden">
                        <h3 class="text-black">Tujuan</h3>
                        <div class="text-black"> {!! $profil->objective !!}</div>
                </div>

            </div>
        @else
            <div class="d-flex">
                <h5 class="m-auto text-muted p-5"><i class="fa-solid fa-folder-open"></i> Data Tidak Ada</h5>
            </div>
        @endif
        <div class="card-footer d-flex gap-2">

            <div class="ms-auto">
                <button wire.loading.attr='disabled' wire.target='destroy' class="btn btn-white" type="button"
                    wire:click="destroy">
                    Kosongkan
                </button>
                <a class="btn btn-success ms-auto" href="{{ route('menu-profil.tujuan.create') }}">
                    Edit Kata Sambutan
                </a>
            </div>

        </div>
    </div>
</div>
