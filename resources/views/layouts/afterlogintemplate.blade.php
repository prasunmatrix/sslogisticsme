<!DOCTYPE html>

<html data-ng-controller="commonController">
<head>
	@include('common.head') 
	@stack('css')
	<script type="text/javascript">
		var baseUrl = "<?php echo URL('');?>";
	</script>
	
</head>
<body class="skin-blue sidebar-mini" ng-cloak>			
	<div id="loderMainDiv" class="loding-div"><div class="loader"></div></div>
	<div class="wrapper" id="pageMainWrapper">
	    @include('common.header')  
	    @include('common.left-menu') 
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" >
			@yield('content')
		</div> 
		@include('common.footer')  
	</div>			
	@include('common.footer-script') 
	<!-- Require Js-->
    @stack('js')
    <script src="{{ asset('/angularJs/bower_components/requirejs/require.js') }}"></script>
    <script src="{{ asset('/angularJs/require_config.js') }}"></script> 
	@yield('scripts')
		
</body>
</html>     
