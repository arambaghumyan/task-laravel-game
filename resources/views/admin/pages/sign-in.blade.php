<!DOCTYPE html>
<html>
<head>
	<title>Admin Login Page</title>
	<style type="text/css">
		body {
		    background-color: #f0f0f0;
		    font-family: Arial, sans-serif;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    height: 100vh;
		    margin: 0;
		}

		.login-container {
		    background-color: #ffffff;
		    border-radius: 5px;
		    padding: 30px;
		    width: 300px;
		}

		.login-container h1 {
		    text-align: center;
		}

		.login-container form {
		    margin-top: 20px;
		}

		.login-container input {
		    width: -webkit-fill-available;
		    padding: 10px;
		    margin-bottom: 10px;
		}

		.login-container button {
		    width: 100%;
		    padding: 10px;
		    background-color: #007bff;
		    color: #ffffff;
		    border: none;
		    cursor: pointer;
		}

		.login-container button:hover {
		    background-color: #0056b3;
		}
	</style>
</head>
<body>
	<div class="login-container">
	    <h1>Login</h1>
	    <div>
		    <form action="{{ route('admin.login') }}" method="post">
		    	@csrf
		    	<div class="form-input">
		        	<input type="text" name="name" placeholder="Username">
		    	</div>
		    	<div class="form-input">
		        	<input type="password" name="password" placeholder="Password">
		    	</div>
		        <button type="submit">Login</button>
		    </form>
	    </div>
	</div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
</body>
</html>
