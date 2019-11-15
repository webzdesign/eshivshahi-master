<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <?php
      $title=DB::table('companydetails')->get();
    ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title[0]->name }}</title>
    @include('partials.header_script')
  </head>

<body class="nav-md">
		<?php /* Hardik Ponkiya Desc: Loader*/ ?>
		<div class="blockUI" style=""></div>
		<div class="blockUI blockOverlay" style="z-index: 1000; border: medium none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(0, 0, 0); opacity: 0.6; cursor: wait; position: fixed;"></div>
		<div class="blockUI blockMsg blockPage" style="z-index: 1011; position: fixed; padding: 15px; margin: 0px; width: 30%; top: 40%; left: 35%; text-align: center; color: rgb(255, 255, 255); border: medium none;  cursor: wait; opacity: 0.5;">
			<img   alt="loading.." src="{{asset('public/assets/images/loader.gif')}}">
		</div>
		<?php /* Hardik Ponkiya Desc: Loader End */ ?>
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
      @include('partials.side_bar')
      </div>

       @include('partials.top_navigation')
        <!-- page content -->
            @yield('content')
        <!-- /page content -->
        @include('partials.footer')
      </div>
    </div>
    @include('partials.footer_script')
    @yield('script')
    @include('partials.common_function')
  </body>
</html>
<script>
	$(".blockUI").hide();
</script>
