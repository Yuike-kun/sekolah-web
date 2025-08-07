<div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-12">
                <div class="authentication-card">
                    <div class="overflow-hidden">
                        <div class="text-center mb-lg-0 pb-3">
                            <a href="{{ route('beranda') }}">
                                <img src="{{ asset('logo/logo-icon.png') }}" width="300">
                            </a>
                        </div>
                        <div class="row g-0 card shadow rounded-0">
                            <div class="">
                                <div class="card-body p-4 p-sm-5">
                                    <h5 class="card-title text-center mb-5">Masuk Ke Akun Anda</h5>

                                    <x-backend.alert />

                                    <form wire:submit='save' class="form-body">
                                        <div class="login-separater text-center mb-4">
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Alamat Email</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                    <x-backend.form.input wire:model.lazy='email' type="email"
                                                        name="email" class="form-control ps-5" id="email"
                                                        placeholder="Masukkan email" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </div>
                                                    <x-backend.form.input wire:model.lazy='password' type="password"
                                                        name="password" class="form-control ps-5" id="password"
                                                        placeholder="Masukkan password" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <div class="d-grid">
                                                    <button wire.loading.attr='disabled' type="submit"
                                                        class="btn btn-success">Masuk</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
