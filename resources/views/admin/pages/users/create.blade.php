@extends('layouts.admin')
@section('css')
<style type="text/css">
	form {
		display: flex;
		flex-direction: column;
		gap: 20px;
		padding: 15px;
	    box-shadow: 2px 1px 15px gray;
	    max-width: 350px;
	    border-radius: 15px;
	}
	form .form-group {
		display: flex;
		flex-direction: column;
		gap: 8px;
	}
	form .form-group input {
		background: #F9FAFA;
		border: 1px solid #ECECEF;
		box-shadow: 0px 4px 0px #DEDFE3;
		border-radius: 1000px;
		padding: 12px 16px;

	}
	form button {
		background: #99FFDD;
		box-shadow: 0px 4px 0px #86DFC2;
		border-radius: 1000px;
		padding: 12px 24px;
		border: none;
		cursor: pointer;
		transition: all 500ms;
		width: max-content;
	}

	form button:hover {
		background: #99FFDD;
		box-shadow: 0px 4px 0px #86DFC2;
	}
</style>
@stop
@section('content')
<div class="container">
	<h4>Create User</h4>
	<form method="post" action="/admin/users">
		@csrf
		<div class="form-input">
			<label>Name</label>
			<input type="text" name="name">
		</div>
		<div class="form-input">
			<label>Phone</label>
			<input type="number" name="phone">
		</div>
		<button type="submit">Create</button>
	</form>
</div>
@endsection