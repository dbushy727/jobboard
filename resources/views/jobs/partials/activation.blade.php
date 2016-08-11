<div class="activation-buttons">
    <form action="/posts/{{$job->slug}}/reject" method="POST" class="form activation-form">
        <div class="form-group">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-danger btn-lg pull-left header-button">Reject</button>
        </div>
    </form>

    <form action="/posts/{{$job->slug}}/activate" method="POST" class="form activation-form pull-right">
        <div class="form-group">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-success btn-lg pull-right header-button">Activate</button>
        </div>
    </form>
</div>