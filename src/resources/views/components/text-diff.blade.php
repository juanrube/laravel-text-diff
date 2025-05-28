<div class="card">
    @if(isset($title))
        <div class="card-header">
            <h5 class="card-title">{{ $title }}</h5>
        </div>
    @elseif(isset($slot) && trim($slot) !== '')
        <div class="card-header">
            <h5 class="card-title">{{ $slot }}</h5>
        </div>
    @endif

    <div class="card-body">
        {!! $diffHtml !!}
    </div>
</div>