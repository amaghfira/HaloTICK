
<!doctype html>
<html lang="en">
  <head>
  	<title>Sign In to MELATI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?= base_url(); ?>/dist/css/style.css">
	<style>
		#melati {
			background: url('<?= base_url() ?>/dist/img/Picture5.png');
			background-size: auto;
			background-repeat: no-repeat;
		}
	</style>
	</head>
	<body>
    <!-- PESAN -->
	<?php if (session()->has('login_dulu')) : ?>
        <div class="alert <?=session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('login_dulu') ?>
        </div>
    <?php endif; ?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div id="melati" class=" p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100" style="opacity: 0;">
								<h2>Selamat Datang di MELATI</h2>
								<p>Manajemen Pelayanan TI</p>
							</div>
			      		</div>
						
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<!-- <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a> -->
									</p>
								</div>
			      	</div>
                            <form method="post" action="<?php echo base_url(); ?>/auth/valid_login" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" name="username" class="form-control" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<!-- <div class="w-50 text-left">
							<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
								<input type="checkbox" checked>
								<span class="checkmark"></span>
							</label>
						</div> -->
						<!-- <div class="w-50 text-md-right">
							<a href="#">Forgot Password</a>
						</div> -->
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

    <script src="<?= base_url(); ?>/dist/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/dist/js/popper.js"></script>
    <script src="<?= base_url(); ?>/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/dist/js/main.js"></script>

	</body>
</html>