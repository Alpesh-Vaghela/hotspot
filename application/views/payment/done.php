<html>
	<head>		
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="/assets/css/component.css" />		
		<script type="text/javascript" src="/assets/js/jquery.js"></script>
		<script type="text/javascript">
			function doredirect() {
				window.location.href = 'http://<?php echo $nas_ip."/login?username=".$username."&password=".$password?>';
			}
		</script>
	</head>
	<body>
		<div class="pages-stack">
			<div class="carousel slide">
				<div class="carousel-inner">
					<div class="item active">
						<div data-parallaxify-range-x="140" class="fill" style="background-image:url('/assets/img/bgBodyCoffee.jpg');"></div>
						<div class="main">
							<div class="header">
								<div class="row">
									<div class="col-lg-4 col-lg-offset-4">
										<form role="form">
											<div class="form-group">
												<div class="col-sm-12 col-xs-10 center-block">
													<form action="http://<?=$nas_ip?>" method="post" id="redirectform">
														<h1>Payment Succes</h1>
														<h2>You login: <?=$username?></h2><br>
														<h2>You password: <?=$password?></h2><br>
														<input type="hidden" name="auth_user" value="<?=$username?>">
														<input type="hidden" name="auth_pass" value="<?=$password?>">
														<input name="redirurl" type="hidden" value="http://hotspot.linefi.net/welcome/status/<?=$cihaztipi->location_name?>?user=<?=$username?>">
														<input name="accept" type="button" onclick="doredirect()" value="Continue" />
													</form>
												</div>
											</div>
										</form>
									</div><!-- /.col-lg-4 -->
								</div><!-- /.row -->
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>




	</body>
</html>

 
