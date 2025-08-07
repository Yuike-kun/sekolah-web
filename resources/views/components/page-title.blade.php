<div>
    <div class="d-flex flex-wrap mt-2 mb-3">
        <div class="row">
            <div class="col-12">
                {{ $pagePretitle }}
            </div>
            <div class="col-12">
                <h4 class="mb-0 text-uppercase text-dark">{{ $pageTitle }}</h4>
            </div>
        </div>

        <div class="ms-lg-auto mt-2 mt-lg-0 aling-self-center">
            {{ $slot }}
        </div>
    </div>
</div>
