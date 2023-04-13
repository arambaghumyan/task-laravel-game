@extends('layouts.admin')
@section('css')
<style type="text/css">
	.container {
		display: flex;
		flex-direction: column;
		gap: 20px;
		margin-top: 30px;
	}
	table {
	   width: 100%;
	   border-collapse: collapse;
	   font-family: Arial, sans-serif;
	 }
	 th, td {
	   padding: 10px;
	   text-align: left;
	   border-bottom: 1px solid #ddd;
	 }
	 th {
	   background-color: #f2f2f2;
	 }
	 /* Table hover effect */
	 tbody tr:hover {
	   background-color: #f9f9f9;
	 }
	 .add-user-btn {
	 	background: green;
	 	color: white;
	 	border: lightgreen;
	 	display: inline-block;
	 	width: max-content;
	 	padding: 12px 24px;
	 	border-radius: 10px;
	 	text-decoration: none;
	 	transition: all 500ms;
	 }

	 .remove-btn {
	 	background: red;
	 	color: white;
	 	display: inline-block;
	 	width: max-content;
	 	padding: 6px 12px;
	 	border-radius: 5px;
	 	text-decoration: none;
	 	transition: all 500ms;
	 	margin-left: 5px;
	 }

	 .edit-btn {
	 	background: orange;
	 	color: white;
	 	display: inline-block;
	 	width: max-content;
	 	padding: 6px 12px;
	 	border-radius: 5px;
	 	text-decoration: none;
	 	transition: all 500ms;
	 	margin-left: 5px;
	 }

	 .add-user-btn:hover,.remove-btn:hover, .edit-btn:hover {
	 	opacity: 0.9;
	 }
</style>
@stop
@section('content')
<div class="container">
	<a href="/admin/users/create" class="add-user-btn">Add User</a>
    <table>
    	<thead>
    		<tr>
    			<th>Name</th>
    			<th>Phone</th>
    			<th>Unique Link</th>
    			<th>Expires At</th>
    			<th>Created At</th>
    			<th>Actions</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($users as $user)
    			<tr>
    				<td>{{ $user->name }}</td>
    				<td>{{ $user->phone }}</td>
    				<td>
    					@if(isset($user->token->token)) <a href="{{ route('home', $user->token->token) }}" target="_blank">{{ route('home', $user->token->token) }}</a>@endif
    				</td>
    				<td>{{ $user->token->expired_at??'' }}</td>
    				<td>{{ $user->created_at }}</td>
    				<td>
    					<a href="{{ route('users.edit', $user->id) }}" class="edit-btn">Edit</a>
    					<form method="post" action="{{ route('users.destroy', $user->id) }}">
    						@csrf
						    @method('DELETE')
    						<button type="submit" class="remove-btn">Remove</button>
    					</form>
    				</td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
</div>
@endsection
