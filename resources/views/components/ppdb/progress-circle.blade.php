<div class="py-3 d-lg-block d-none">
    <div class="position-relative m-4">
        <div class="progress" style="height: 1px;">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <button type="button"
            class="position-relative top-0 translate-middle btn btn-sm btn-circle-progress rounded-pill"
            style="width: 3rem; height:3rem; left: 0;">1</button>
        <button type="button"
            class="position-relative top-0 translate-middle btn btn-sm {{ $currStep >= 2 && $currStep <= 5 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
            style="width: 3rem; height:3rem; left: 220px;">2</button>
        <button type="button"
            class="position-relative top-0 translate-middle btn btn-sm {{ $currStep >= 3 && $currStep <= 5 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
            style="width: 3rem; height:3rem; left: 435px;">3</button>
        <button type="button"
            class="position-relative top-0 translate-middle btn btn-sm {{ $currStep >= 4 && $currStep <= 5 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
            style="width: 3rem; height:3rem; left: 670px;">4</button>
        <button type="button"
            class="position-relative top-0 translate-middle btn btn-sm {{ $currStep == 5 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
            style="width: 3rem; height:3rem; left: 880px;">5</button>
    </div>
</div>
