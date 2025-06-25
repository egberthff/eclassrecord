<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>BISU e-Class Record</title>

		<!-- Meta -->
		<meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<link rel="shortcut icon" href="{{ URL::to('assets/images/favicon.svg')}}" />

		<!-- *************
			************ CSS Files *************
		************* -->
		<link rel="stylesheet" href="{{ URL::to('assets/fonts/bootstrap/bootstrap-icons.css')}}" />
		<link rel="stylesheet" href="{{ URL::to('assets/css/main.min.css')}}" />
		<style>
            .floating-btn {
              position: fixed;
              top: 10px; 
              left: 10px; 
              background-color: #ffcd04; 
              color: white;
              padding: 10px 15px;
              text-decoration: none;
              border-radius: 5px;
              box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
              font-family: Arial, sans-serif;
              font-size: 16px;
              z-index: 1000; 
              transition: background-color 0.3s ease;
            }
        
            .floating-btn:hover {
              background-color: #4f247b; /* Change color on hover */
            }
        </style>
	</head>

	<body>
		<a href="https://bisu-systems.thsite.top" class="floating-btn">
        <i class="bi bi-house"></i>
        </a>
		<!-- Container start -->
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
						<div class="border rounded-2 p-4 mt-5">
							<div class="login-form">
                                @csrf
								<h5 class="fw-bold mb-5">
                                    <img src="/logo.png" class="img-fluid login-logo" alt="Mars Admin Dashboard" style="width: 100px;height: 100px;"/>
                                    BISU e-Class Record</h5>
								<div class="mb-3">
									<label class="form-label">Username</label>
									<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter username" />
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

								</div>
								<div class="mb-3">
									<label class="form-label">Password</label>
									<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" />
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="d-grid py-3 mt-4">
									<button type="submit" class="btn btn-lg btn-primary">
										LOGIN
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Container end -->
	</body>

</html>