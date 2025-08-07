<div>
    <x-page-title pagePretitle="Menampilkan Sejarah" pageTitle="Sejarah" />
    <x-backend.alert />
    <div class="card rounded-1" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">

        @if (isset($profil->history))
            <div class="card-body d-lg-flex my-5 mx-4 card-img-top">
                <div class="mx-lg-5 align-self-center mb-3">

                    @if (isset($profil->image_06))
                        <img src="{{ asset('storage/' . $profil->image_06) }}" width="200" height="200">
                    @else
                        <img src="{{ asset('backend/assets/images/NoImage.png') }}" alt="photo" width="200"
                            height="200">
                    @endif
                </div>
                <div class="mx-lg-5 overflow-hidden">
                    <h3 class="text-black">Sejarah</h3>
                    <p class="text-black"> {!! $profil->history !!}</p>
                </div>
            </div>
        @else
            <div class="d-flex">
                <h5 class="m-auto text-muted p-5"><i class="fa-solid fa-folder-open"></i> Tidak Ada Sejarah</h5>
            </div>
        @endif

        <div class="card-footer d-flex">
            <div class="d-flex gap-2 ms-auto">
                <button wire.loading.attr='disabled' wire.target='destroy' class="btn btn-white" type="button"
                    wire:click="destroy">
                    Kosongkan
                </button>
                <a class="btn btn-success ms-auto" href="{{ route('menu-profil.sejarah.create') }}">
                    Edit Sejarah
                </a>
            </div>
        </div>

    </div>
</div>
