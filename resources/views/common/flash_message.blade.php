@foreach (['danger', 'warning', 'success', 'info','error'] as $msg)
    @if(Session::has('alert-' . $msg))
        <p class="flashMsgHolder alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!}
        </p>
    @endif
@endforeach