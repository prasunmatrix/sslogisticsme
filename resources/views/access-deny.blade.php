@extends('layouts.afterlogintemplate') 
@section('content')
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-red">403</h2>
            <div class="error-content">
                <h3><i class="fa fa-warning text-red"></i> Forbidden</h3>
                <p>
                    Either you don't have permission to access this page or have placed wrong URL. If you don't have permission to access this page your identification and ip address would be tracked..
                </p>
                
            </div>
        </div>
    </section>
@stop
@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/common/commonApp.js') }}"></script>
@endsection