<div class="py-3 d-lg-block d-none">
    <div class="position-relative m-4">
        <!-- Progress bar -->
        <div class="progress" style="height: 1px; position: absolute; top: 50%; left: 0; width: 100%;">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>

        <!-- Step buttons -->
        <div class="d-flex justify-content-between position-relative" style="z-index: 1;">
            <button type="button" class="btn btn-sm btn-circle-progress rounded-pill"
                style="width: 3rem; height:3rem;">1</button>
            <button type="button"
                class="btn btn-sm {{ $currStep >= 2 && $currStep <= 5 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
                style="width: 3rem; height:3rem;">2</button>
            <button type="button"
                class="btn btn-sm {{ $currStep >= 3 && $currStep <= 5 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
                style="width: 3rem; height:3rem;">3</button>
            <button type="button"
                class="btn btn-sm {{ $currStep >= 4 && $currStep <= 5 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
                style="width: 3rem; height:3rem;">4</button>
            <button type="button"
                class="btn btn-sm {{ $currStep >= 5 && $currStep <= 6 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
                style="width: 3rem; height:3rem;">5</button>
            <button type="button"
                class="btn btn-sm {{ $currStep == 6 ? 'btn-circle-progress' : 'btn-secondary' }} rounded-pill"
                style="width: 3rem; height:3rem;">6</button>
        </div>
    </div>
</div>
