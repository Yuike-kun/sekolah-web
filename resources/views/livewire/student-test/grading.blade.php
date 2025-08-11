<div>
    <x-backend.alert />
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">
                        Data Calon Siswa
                    </h3>
                    <table class="table table-hover">
                        <tr>
                            <th>NIK</th>
                            <td>{{ $siswa_data->student->nik }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $siswa_data->student->full_name }}</td>
                        </tr>
                        <tr>
                            <th>NISN</th>
                            <td>{{ $siswa_data->student->nisn }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $siswa_data->student->gender }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">
                        Hasil Tes Ujian
                    </h4>
                    @php($i = 1)
                    @foreach ($answers as $a)
                        <div class="mb-3">
                            <p>
                                {{ $i }}. {{ $a->question->question }} (Poin : {{ $a->question->points }})
                                <br>
                                @if ($a->question->type == 'multiple_choice')
                                    <b>Jawab : {{ $a->answer_multiple_choice->option_text }}</b>
                                    @if ($a->answer_multiple_choice->is_correct)
                                        <span class="badge rounded-pill text-bg-success">Benar</span>
                                        @if($this->points == 0)
                                            @php($this->points += $a->question->points)
                                        @endif
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">Salah</span>
                                    @endif
                                @else
                                    <b>Jawab : {{ $a->answer }}</b> <br>
                                    <input type="number" class="form-control form-control-sm w-25"
                                        wire:model.lazy="essay_points.{{ $a->id }}" wire:blur="essayPoints"
                                        {{-- onkeyup="this.value > {{ $a->question->points }} ? this.value = {{ $a->question->points }} : this.value = this.value" --}}
                                        placeholder="Masukkan Nilai 0 - {{ $a->question->points }}" />
                                @endif
                            </p>
                        </div>
                        @php($i++)
                    @endforeach
                    <div class="alert alert-primary" role="alert">
                        <h4 class="mb-0">Total Poin : {{ $this->points }} / {{ $sum_point }}</h4>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-success" wire:click="save">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
