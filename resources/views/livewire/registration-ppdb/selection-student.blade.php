<div class="container my-5">
    <div class="card p-5">
        <div class="table-responsive card" wire:loading.class.delay="card-loading" wire:offline.class="card-loading">
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>
                            <x-datatable.column-sort name="No. Pendaftaran" wire:click="sortBy('number_registration')"
                                :direction="$sorts['number_registration'] ?? null" />
                        </th>
                        <th>
                            <x-datatable.column-sort name="NISN" wire:click="sortBy('nisn')" :direction="$sorts['nisn'] ?? null" />
                        </th>
                        <th>
                            <x-datatable.column-sort name="NIK" wire:click="sortBy('nik')" :direction="$sorts['nik'] ?? null" />
                        </th>
                        <th>
                            <x-datatable.column-sort name="Nama Lengkap" wire:click="sortBy('full_name')"
                                :direction="$sorts['full_name'] ?? null" />
                        </th>
                        <th>
                            <x-datatable.column-sort name="Status Kelulusan"
                                wire:click="sortBy('verification_graduation')" :direction="$sorts['verification_graduation'] ?? null" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr wire:key="{{ $loop->index }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->student->number_registration }}</td>
                            <td>{{ $item->student->nisn }}</td>
                            <td>{{ $item->student->nik }}</td>
                            <td>{{ $item->student->full_name }}</td>
                            <td>
                                <div
                                    class="{{ $item->student->verification_graduation == 'Proses' ? 'animated-dots' : '' }} {{ ($item->student->verification_graduation == 'Proses' ? 'badge-primary' : $item->student->verification_graduation == 'Tidak Lulus') ? 'badge-danger' : 'badge-success' }}">
                                    {{ $item->student->verification_graduation }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-datatable.empty colspan="7" />
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
