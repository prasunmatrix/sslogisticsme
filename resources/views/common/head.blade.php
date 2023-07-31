
    <meta charset="UTF-8">
    <title>SSLogistics</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">

    <!-- JQuery -->
    <script src="{{asset('resources')}}/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- AdminLTE App -->
    <script src="{{asset('resources')}}/dist/js/app.min.js" type="text/javascript"></script>

    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('resources')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('resources')}}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{asset('resources')}}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />



     <link href="{{ asset('angularJs/bower_components/angular-treasure-overlay-spinner/dist/treasure-overlay-spinner.min.css') }}" rel="stylesheet">

    <!--<link rel="stylesheet" href="{{asset('resources')}}/plugins/crop/example/css/slim.min.css">-->
    <!--<link href="{{ asset('angularJs/bower_components/angular-treasure-overlay-spinner/dist/treasure-overlay-spinner-min.css') }}" rel="stylesheet">-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="{{ asset('angularJs/bower_components/crop/slim/slim.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <script src="{{asset('js/common.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script src="{{asset('js/html2canvas.min.js')}}"></script>
  


    <!--<script src="{{asset('angularJs/bower_components/pdfmake/build/pdfmake.min.js')}}"></script>-->
    <script src="{{asset('angularJs/bower_components/pdfmake/build/vfs_fonts.js')}}"></script>


    <!-- Date Picker -->
    <link href="{{asset('resources')}}/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <script src="{{asset('resources')}}/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js" type="text/javascript"></script>


    <script src="{{asset('js/jspdf.min.js')}}"></script>
        

    <!-- Date Time Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!--<script src="{{asset('angularJs/bower_components/daterangepicker/moment.js')}}"></script>
    <script src="{{asset('angularJs/bower_components/daterangepicker/daterangepicker.js')}}"></script>
    <link rel="stylesheet" href="{{asset('angularJs/bower_components/daterangepicker/daterangepicker-bs3.css')}}"/>-->


    <script src="{{asset('js/date.js')}}"></script>
    
    <script src="{{ asset('/js/loadingoverlay.js') }}"></script>
    <script type="text/javascript">
        $("#loadingBar").LoadingOverlay("show");     
    </script>





    
  
  