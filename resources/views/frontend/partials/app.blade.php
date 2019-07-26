<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('pageTitle')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('styles/bootstrap4/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet">
<link href="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}" rel="stylesheet">
<link href="{{asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}" rel="stylesheet">
<link href="{{asset('plugins/OwlCarousel2-2.2.1/animate.css')}}" rel="stylesheet">
<link href="{{asset('styles/main_styles.css')}}" rel="stylesheet">
<link href="{{asset('styles/responsive.css')}}" rel="stylesheet">
@yield('css')

</head>
<body>
    @include('frontend.partials.header')

    @yield('content')
</div>

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('plugins/scrollTo/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('plugins/easing/easing.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
@yield('script')
</body>
</html>
