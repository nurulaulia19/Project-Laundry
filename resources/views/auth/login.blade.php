@extends('layouts.main')
@section('content')
    <div id="container" class="cls-container">
        
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">Account Login</h1>
		                <p>Sign In to your account</p>
		            </div>
		            <form method="POST" action="{{ route('login') }}">
						@csrf
		                <div class="form-group">
		                    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus placeholder="username">
                                    @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
		                </div>
		                <div class="form-group">
		                    <input id="user_password" type="password" class="form-control @error('user_password') is-invalid @enderror" name="user_password" required autocomplete="user_password" placeholder="password">
                                @error('user_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		                </div>
		                {{-- <div class="checkbox pad-btm text-left">
		                    <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
		                    <label for="demo-form-checkbox">Remember me</label>
		                </div> --}}
		                <button class="btn btn-lg btn-block" style="background-color: #DA0C81; color:white" type="submit">Sign In</button>
		            </form>
		        </div>
		
		        {{-- <div class="pad-all">
		            <a href="{{ route('register') }}" class="btn-link mar-lft">Create a new account</a>
		
		            <div class="media pad-top bord-top">
		            </div>
		        </div> --}}
		    </div>
		</div>
@endsection








