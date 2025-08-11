<div>
    <div class="card mb-3">
        <div class="card-header bg-primary border-bottom-0 text-white d-flex justify-content-between">
            <span>
                Soal {{ $this->step + 1 }}
            </span>
            <span>
                <span class="badge rounded-pill text-bg-success" style="font-size: 12px">
                    Sisa Waktu : <span id="timeRemain"></span>
                </span>
            </span>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <p class="fs-3 m-0">
                    {{ $questions[$this->step]['question'] }}
                </p>
            </div>
        </div>
        @if (session('alert'))
            <div class="alert border-0 bg-light-{{ session('alert.type') }} alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    @if (session('alert.type') == 'danger')
                        <div class="fs-3 text-{{ session('alert.type') }}"><i class="bi bi bi-x-circle-fill"></i></div>
                    @else
                        <div class="fs-3 text-{{ session('alert.type') }}"><i class="bi bi bi-check-circle-fill"></i>
                        </div>
                    @endif
                    <div class="ms-3">
                        <div class="text-{{ session('alert.type') }}">
                            <b>{{ session('alert.message') }} </b>{{ session('alert.detail') }}
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex flex-column gap-1">
            @php($i = 0)
            @if (is_null($questions[$this->step]['question_essay']))
                @foreach ($questions[$this->step]['question_multiple_choice'] as $answers)
                    <div class="card">
                        <div class="card-body d-flex gap-4 align-items-center" wire:key="page-{{ $this->step }}">
                            <input type="radio" class="btn-check"
                                wire:model="answer.{{ $this->step }}.{{ $questions[$this->step]['id'] }}.value"
                                name="answer.{{ $this->step }}.{{ $questions[$this->step]['id'] }}.value"
                                id="answer-{{ $i }}" autocomplete="off"
                                style="border-radius: 100%; width: 50px; height: 50px;" value="{{ $answers['id'] }}">
                            <label class="btn btn-outline-primary"
                                for="answer-{{ $i }}">{{ chr(65 + $i) }}</label>
                            <h4 class="mb-0">{{ $answers['option_text'] }}</h4>
                        </div>
                    </div>
                    @php($i++)
                @endforeach
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="answer.{{ $this->step }}.{{ $questions[$this->step]['id'] }}.value"
                                class="form-label">Jawaban Essai</label>
                            <textarea class="form-control" name="answer.{{ $this->step }}.{{ $questions[$this->step]['id'] }}.value"
                                wire:model="answer.{{ $this->step }}.{{ $questions[$this->step]['id'] }}.value"
                                id="answer.{{ $this->step }}.{{ $questions[$this->step]['id'] }}.value" rows="3"
                                placeholder="Masukkan jawaban disini"></textarea>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="card fixed-bottom m-0 shadow-lg">
        <div class="card-body d-flex justify-content-between">
            <button class="btn btn-outline-secondary" wire:click="decreaseStep" @disabled($this->step == 0)>
                Sebelumnya
            </button>
            @if ($this->step < count($this->soal) - 1)
                <button class="btn btn-outline-success" wire:click="increaseStep">
                    Selanjutnya
                </button>
            @else
                <button class="btn btn-outline-success" wire:click="save">
                    Selesai
                </button>
            @endif
        </div>
    </div>

    <script>
        // Set initial countdown duration in seconds (e.g., 1h 30m 45s)
        const initialDuration = (1 * 3600) + (30 * 60) + 45;

        const countdownEl = document.getElementById('timeRemain');

        // Load or set the countdown end time
        let endTime = localStorage.getItem('countdownEndTime');
        if (!endTime) {
            // Set new end time and store it
            endTime = Date.now() + initialDuration * 1000;
            localStorage.setItem('countdownEndTime', endTime);
        } else {
            endTime = parseInt(endTime, 10);
        }

        function setEndTime(durationSeconds) {
            const newEnd = Date.now() + durationSeconds * 1000;
            localStorage.setItem(storageKey, newEnd);
            endTime = newEnd;
        }

        function updateCountdown() {
            const now = Date.now();
            const remainingTime = Math.max(0, Math.floor((endTime - now) / 1000));

            const hours = Math.floor(remainingTime / 3600);
            const minutes = Math.floor((remainingTime % 3600) / 60);
            const seconds = remainingTime % 60;

            // Display
            countdownEl.textContent =
                `${String(hours).padStart(2, '0')}:` +
                `${String(minutes).padStart(2, '0')}:` +
                `${String(seconds).padStart(2, '0')}`;

            // If countdown reaches 0
            if (remainingTime <= 0) {
                clearInterval(timer);
                localStorage.removeItem('countdownEndTime');
                alert("Countdown finished!");
            }
        }

        updateCountdown(); // initial display
        const timer = setInterval(updateCountdown, 1000);

        Livewire.on('countdownReset', () => {
            setEndTime(3600);
        });
    </script>
</div>
