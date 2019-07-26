<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
    <link href="{{asset('styles/bootstrap4/bootstrap.min.css')}}" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<div class="bg-wrapper">
		<div class="bg-grad orange active"></div>
		<div class="bg-grad red"></div>
		<div class="bg-grad purple"></div>
		<div class="bg-grad blue"></div>
		<div class="bg-grad green"></div>
		<div class="bg-grad yellow"></div>
	</div>
	<div class="login-wrapper">
		<div class="x-wrapper">
			<div class="y-wrapper">
				<div class="title-wrapper">
					<h2>Welcome!</h2>
					<h4>Please Login</h4>
				</div>
                <form id="login-form" class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">


                <div class="input-box form-group">
					<input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
					<input type="password" class="form-control" name="password" placeholder="Password"><span class="show-pass icon-eye" title="show characters"></span>
				</div>
             
                </form>
				<div class="button-wrapper">
					<a href="#">forgot password</a> | <a href="{{route('front.home')}}">Back</a>
                    <a href="{{ route('auth.login') }}"onclick="event.preventDefault(); document.getElementById('login-form').submit();">
					<span class="login-btn">Login&raquo;</span>
                    </a>
				</div>
                         
			</div>
		</div>
	</div>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/login.js')}}"></script>
</body>
</html>