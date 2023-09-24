
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
<div class="container ">
	<div class="col-12 d-flex justify-content-center ">
		<div class="user_card">
			<div class="d-flex justify-content-center">
				<div class="brand_logo_container">
					<img src="{{ asset('assets/img/katapang.png') }}" class="brand_logo" alt="Logo">
				</div>
			</div>
			<div class="d-flex justify-content-center form_container">
				<form action="{{ route('actionlogin') }}" method="post">
					@csrf
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" name="email" class="form-control input_user" value="" required="" placeholder="Email">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control input_pass" value="" required="" placeholder="Password">
					</div>
						<div class="d-flex justify-content-center mt-4 login_container">
						<button type="submit" name="submit" id="submit" class="btn login_btn">Login</button>
					</div>
				</form>
			</div>
			<div class="mt-4">
				<div class="d-flex justify-content-center links">
					Belum Punya Akun? <a href="/register" class="ml-2">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	 @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ Session::get('success') }}',
        });
    @endif

    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ Session::get('error') }}',
        });
    @endif
</script>
</body>
</html>

