	<!-- Header -->

	<header class="header d-flex flex-row">
		<div class="header_content d-flex flex-row align-items-center">
			<!-- Logo -->
			<div class="logo_container">
				<div class="logo">
					<img src="images/logo.png" alt="">
					<span>course</span>
				</div>
			</div>

			<!-- Main Navigation -->
			<nav class="main_nav_container">
				<div class="main_nav">
					<ul class="main_nav_list">
						<li class="main_nav_item"><a href="/">home</a></li>
						<li class="main_nav_item"><a href="#">about us</a></li>
						<li class="main_nav_item"><a href="{{route('front.course')}}">courses</a></li>
						<!-- <li class="main_nav_item"><a href="#">news</a></li> -->
						<li class="main_nav_item"><a href="contact.html">contact</a></li>
						@if (\Auth::check()) 
							@if (\Auth::user()->isStudent())
								<li class="main_nav_item"><a href="{{ route('front.profile')}}">Profile</a></li>
							@else
								<li class="main_nav_item"><a href="{{ url('/admin') }}">Controll</a></li>
							@endif
							<li class="main_nav_item">
						
							<a href="{{ route('auth.logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    		
                   	 			<span class="title">@lang('Logout')</span>
                			</a>
                    
						<form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        	@csrf
                    	</form>
						</li>
						@else
						<li class="main_nav_item"><a href="{{ route('login') }}">Login</a></li>
						@endif
					</ul>
				</div>
			</nav>
		</div>
		<div class="header_side d-flex flex-row justify-content-center align-items-center">
			<img src="images/phone-call.svg" alt="">
			<span>+43 4566 7788 2457</span>
		</div>

		<!-- Hamburger -->
		<div class="hamburger_container">
			<i class="fas fa-bars trans_200"></i>
		</div>

	</header>