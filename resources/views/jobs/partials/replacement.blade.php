<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs text-center" role="tablist">
        <li role="presentation" class="preview-tab"><a href="#original" aria-controls="original" role="tab" data-toggle="tab">Original</a></li>
        <li role="presentation" class="active preview-tab"><a href="#revision" aria-controls="revision" role="tab" data-toggle="tab">Revision</a></li>
    </ul>
    <br>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="original">
            <?php $job = $job->original; ?>
            @include('jobs.partials.job')
        </div>

        <div role="tabpanel" class="tab-pane active" id="revision">
            <?php $job = $job->replacement; ?>
            @include('jobs.partials.job')
        </div>
    </div>
</div>