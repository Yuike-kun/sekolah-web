<div class="datatable-perpage ms-lg-auto">
    <x-backend.form.select wire:model.live='perPage' name="perPage">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>

        @if (isset($all))
            <option value="all">Semua</option>
        @endif
    </x-backend.form.select>
</div>
