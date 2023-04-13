@extends('layouts.master')

@section('css')
	<style type="text/css">
		#registration {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}

		#registration form {
			display: flex;
			flex-direction: column;
			gap: 20px;
			padding: 15px;
		    box-shadow: 2px 1px 15px gray;
		    min-width: 350px;
		    border-radius: 15px;
		}

		#registration form .form-group {
			display: flex;
			flex-direction: column;
			gap: 8px;
		}
		#registration form .form-group input {
			background: #F9FAFA;
			border: 1px solid #ECECEF;
			box-shadow: 0px 4px 0px #DEDFE3;
			border-radius: 1000px;
			padding: 12px 16px;

		}
		#registration form button {
			background: #99FFDD;
			box-shadow: 0px 4px 0px #86DFC2;
			border-radius: 1000px;
			padding: 12px 24px;
			border: none;
			cursor: pointer;
			transition: all 500ms;
		}

		#registration form button:hover {
			background: #99FFDD;
			box-shadow: 0px 4px 0px #86DFC2;
		}
	</style>
@stop
@section('content')
<section id="registration">
	<form method="post" action="{{ route('register.submit') }}">
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name">
		</div>
		<div class="form-group">
			<label>Phone</label>
			<input type="number" name="phone">
		</div>
		<button type="submit">Register</button>
	</form>
</section>
@endsection