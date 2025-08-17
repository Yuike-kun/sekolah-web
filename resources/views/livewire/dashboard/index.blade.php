<div>

    <x-page-title page-title="Dashboard" page-pretitle="Ringkasan aplikasi anda.">
        @if (auth()->user()->role == 'admin')
            @if (isset($profil->is_active_ppdb))
                <button wire:click='toggleActivePPDB'
                    class="btn {{ $profil->is_active_ppdb ? 'btn-success' : 'btn-dark' }} mb-2">PPDB
                    {{ $profil->is_active_ppdb ? 'AKTIF' : 'NONAKTIF' }}</button>
            @else
                <button wire:click='toggleActivePPDB' class="btn btn-dark mb-2">PPDB
                    NONAKTIF</button>
            @endif
        @endif
    </x-page-title>

    <x-backend.alert />

    @if (auth()->user()->role == 'admin')
        <div class="row">
            <div wire:ignore.self class="accordion mb-3" id="accordion-example">
                <div class="accordion-item text-success">
                    <h2 class="accordion-header border border-success rounded-1 d-flex" id="heading-1">
                        <button class="accordion-button bg-white text-success d-inline-block" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                            10 Pendaftar Terakhir Yang Belum Diverifikasi.
                        </button>
                    </h2>

                </div>
                <div wire:ignore.self id="collapse-1" class="accordion-collapse collapse"
                    data-bs-parent="#accordion-example">
                    <div class="accordion-body pt-0 bg-white border border-top-0 border-success rounded-bottom-1">
                        <div class="list-group list-group-flush list-group-hoverable text-center">
                            @forelse ($registrations as $registration)
                                <div class="list-group-item px-0 pb-0">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col text-start">
                                            No. Registrasi <br /> [{{ $registration->number_registration ?? '-' }}]
                                        </div>
                                        <div class="col text-start">
                                            NISN <br /> [{{ $registration->nisn ?? '-' }}]
                                        </div>
                                        <div class="col text-start text-truncate">
                                            Nama <br /> {{ $registration->full_name ?? '-' }}
                                        </div>
                                        <div class="col text-truncate">
                                            <span class="badge badge-danger">
                                                {{ $registration->verification_student }}
                                            </span>
                                        </div>

                                        <div class="col">
                                            <button wire:click='handleVerification({{ $registration->id }})'
                                                class="btn btn-sm btn-success">Verfikasi</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center pt-3"><i class="fa-solid fa-folder-open"></i> Tidak Ada
                                    Pendaftar Baru.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="card mt-3 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Verifikasi Tahun Ini</div>

                            <div class="ms-auto lh-1">
                                <span class="badge badge-primary">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $verification ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Lulus Tahun Ini</div>

                            <div class="ms-auto lh-1">
                                <span class="badge badge-primary">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $graduation ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3 flex">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>Tidak Lulus Tahun Ini</div>

                            <div class="ms-auto lh-1">
                                <span class="badge badge-primary">Total</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline mt-3">
                            <div class="h1 mb-0 me-2" style="font-size: 30px;">{{ $notGraduation ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 d-flex mb-5">
                <div class="card h-100 mt-2 w-100" wire:ignore>
                    <div class="card-body">
                        <h5 class="card-title">Data Pendaftaran Tahun Ini</h5>

                        <div data-siswa-lulus="{{ json_encode($lulus['data']) }}"
                            data-siswa-tidak-lulus="{{ json_encode($tidakLulus['data']) }}"
                            date="{{ json_encode($pendaftaran['date']) }}" id="chart-mentions" class="chart-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->role != 'admin')
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body d-flex align-items-center flex-column">
                        <img src="https://placehold.co/100x100" class="img-fluid rounded-circle">
                        <h4>{{ auth()->user()->name }}</h4>
                        <table class="w-100" cellpadding="2">
                            <tr>
                                <th style="width: 150px;">NIK</th>
                                <td>{{ auth()->user()->ppdb->student->nik }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">NISN</th>
                                <td>{{ auth()->user()->ppdb->student->nisn }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">Jurusan</th>
                                <td>{{ auth()->user()->ppdb->student->competence }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">Jenis Kelamin</th>
                                <td>{{ auth()->user()->ppdb->student->gender }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px;">Status</th>
                                <td>
                                    {{ auth()->user()->ppdb->student->verification_graduation }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center mb-3">Detail Ujian Anda</h4>
                        <hr>
                        <div class="row">
                            <div class="col-6 d-flex flex-column align-items-center">
                                <h5>Status Ujian</h5>
                                @if ($this->checkIfAlreadyDoTest())
                                    <span class="badge rounded-pill text-bg-success" style="font-size: 13px">Sudah
                                        Mengikuti</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger" style="font-size: 13px">Belum
                                        Mengikuti</span>
                                @endif
                            </div>
                            {{-- <div class="col-6 col-lg-3 d-flex flex-column align-items-center">
                                <h5>Jawaban Benar</h5>
                                <div style="width: 50px; height: 50px; border-radius: 50%;"
                                    class="bg-primary d-flex justify-content-center align-items-center fs-6 text-white">
                                    5
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 d-flex flex-column align-items-center">
                                <h5>Jawaban Salah</h5>
                                <div style="width: 50px; height: 50px; border-radius: 50%;"
                                    class="bg-primary d-flex justify-content-center align-items-center fs-6 text-white">
                                    0
                                </div>
                            </div> --}}
                            <div class="col-6 d-flex flex-column align-items-center">
                                <h5>Nilai Anda</h5>
                                <div style="width: 50px; height: 50px; border-radius: 50%;"
                                    class="bg-{{ $this->checkGrade()?->grade <= 69 ? 'danger' : 'success' }} d-flex justify-content-center align-items-center fs-6 text-white fw-bold">
                                    {{ $this->checkGrade()?->grade }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@section('script')
    <script src="{{ asset('backend/assets/js/chart.js') }}"></script>

    <script>
        const item = document.getElementById('chart-mentions');

        window.ApexCharts && (new ApexCharts(item, {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 380,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
                stacked: true,
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Siswa Lulus",
                data: JSON.parse(item.getAttribute('data-siswa-lulus'))
            }, {
                name: "Siswa Tidak Lulus",
                data: JSON.parse(item.getAttribute('data-siswa-tidak-lulus'))
            }],
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: JSON.parse(item.getAttribute('date')),
            colors: ["#12BF24", "#bfe399"],
            legend: {
                show: false,
            },
        })).render();
    </script>
@endsection
