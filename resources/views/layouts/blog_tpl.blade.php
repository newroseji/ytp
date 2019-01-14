<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Yestopo is a special platform where you can find all sort of merchandise that you can use for your daily life. We try to update with the latest and greatest items that you deserve.">
    <meta name="author" content="Niraj Byanjankar">
    <link rel="canonical" href="http://www.yestopo.com/{{Request::segment(1)}}" />
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>


<!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.v4/bootstrap.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="{{ asset('css/blog.css') }}" rel="stylesheet">

<link href="{{ asset('css/sticky-footer.css') }}" rel="stylesheet">



@yield('ext_css')
  </head>

  <body>

    <div class="container">
      @include('layouts.blog_header')

      @include('layouts.blog_nav')
      
      @yield('breadcrumbs')

      @yield('jumbotron')

      @yield('featured_posts')
    </div>
      <div role="main" class="container p-0">
        @yield('content')

      </div><!-- /.container -->

    
      <footer class="footer">
        <div class="footer-container">
        <p>&copy; yestopo.com, 2018<?php if(date('Y')!=2018) echo " - " . date('Y') ?></p>
        <p>
          <a href="#">Back to top</a>
        </p>
        </div>
      </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/jquery.v321/jquery-slim.min.js') }}" ></script>
    <script>window.jQuery || document.write('<script src="../../public/js/jquery.v321/jquery-slim.min.js"><\/script>')</script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.v4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/holder.min.js') }}"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>

    @yield('ext_js')

  </body>
</html>
