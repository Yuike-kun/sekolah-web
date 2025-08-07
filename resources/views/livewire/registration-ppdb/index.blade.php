<div>
    <section class="banner contact-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-us-banner-content mt-2">
                        <h2>Pendaftaran Siswa Baru MTsQ Azhar Center Makassar.</h2>
                        <div class="d-flex gap-2 justify-content-center carousel-btn">
                            <a id="daftar" href="{{ route('ppdb.registrasi-siswa') }}"
                                class="common-btn common-btn-warning common-btn-3 d-flex" data-animation="fadeInUp"
                                data-delay=".9s"><i class="fa-solid fa-user-graduate m-auto me-lg-2 me-1"></i> Daftar
                                Sekarang </a>

                            <button data-bs-toggle="modal" data-bs-target="#example-registration-ppdb-modal"
                                class="common-btn common-btn-danger common-btn-3 d-flex" data-animation="fadeInUp"
                                data-delay=".9s"><i class="fa-solid fa-right-to-bracket m-auto me-lg-2 me-1"></i> Masuk
                                Ke Akun </button>

                            <a href="{{ route('ppdb.hasil-seleksi') }}"
                                class="common-btn common-btn-success common-btn-3 d-flex" data-animation="fadeInUp"
                                data-delay=".9s"><i class="fa-solid fa-square-check m-auto me-lg-2 me-1"></i> Hasil
                                Seleksi </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-two-choose">
        <div class="container">
            <div class="row my-5">
                <div class="col-xl-6">
                    <div class="home-two-choose-left-content wow fadeInUp">
                        <div class="home-two-choose-left-content-inner">
                            <div class="common-title">
                                <span>INFORMASI</span>
                                <h3>Syarat & Ketentuan Pendaftaran.</h3>
                            </div>
                            <ul>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Mengisi Formulir Pendaftaran</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Berusia Maksimal 21 Tahun</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Menyerahkan Foto (Hitam Putih) Ukuran 2 x 3
                                            Sebanyak 2 Lembar</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Ijazah SD/MI + Foto Copy 1 Lembar</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Foto Copy Raport Semester 5 Dilegalisir 1
                                            Lembar</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Menunjukkan Piagam Asli dan Foto Copy
                                            Kejuruan</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Foto Copy Kartu Keluarga 3 Lembar</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <div class="home-two-choose-left-content-info d-flex flex-column">
                                        <p class="fw-bold text-dark my-auto">Foto Copy PKH dan KIP</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="gap-2 justify-content-center carousel-btn d-flex mb-3">
                                <a href="#"
                                    class="scroll-bar-text common-btn common-btn-warning common-btn-3 me-auto"
                                    data-animation="fadeInUp" data-delay=".9s"><i
                                        class="fa-solid fa-arrow-up m-auto me-2"></i> Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 mt-5 mt-lg-0">
                    <div class="mission-left-content wow fadeInUp mt-lg-5 pt-lg-4 mt-0 mb-5">
                        <div class="mission-image-one text-center">
                            <img src="{{ asset('images/alur-pendaftaran.jpg') }}" alt="photo">
                        </div>

                        <div class="mission-shape-two">
                            <img src="{{ asset('frontend/assets/images/mission-shape-02.png') }}" alt="photo">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-backend.modal target="registration-ppdb">
        <x-frontend.alert/>
            <div class="text-center mb-5">
                <h5 class="text-dark">Masuk Ke Akun Siswa</h5>
            </div>

            <form wire:submit='save'>
                <div class="form-group mb-3">
                    <x-backend.form.input wire:model.lazy='numberRegistration' name="numberRegistration"
                        label="No. Registrasi" placeholder="Nomor Registrasi" />
                </div>

                <div class="form-group mb-3">
                    <x-backend.form.input wire:model.lazy='nisn' name="nisn" label="NISN Siswa"
                        placeholder="NISN" />
                </div>

                <div class="form-group d-grid">
                    <button id="btn-login-student" type="submit" class="btn w-full pb-2">Masuk</button>
                </div>
            </form>

    </x-backend.modal>
</div>
