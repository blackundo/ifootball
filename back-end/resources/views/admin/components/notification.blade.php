@if(session('notification'))
    <div class="alert alert-warning" role="alert">
        {{session('notification')}}
    </div>
@endif
