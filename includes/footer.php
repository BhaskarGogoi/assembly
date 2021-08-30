<section class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				Copyright &copy; 2019
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="ip-address">
					<?php
						// Function to get the client IP address
						function get_client_ip() {
						    $ipaddress = '';
						    if (getenv('HTTP_CLIENT_IP'))
						        $ipaddress = getenv('HTTP_CLIENT_IP');
						    else if(getenv('HTTP_X_FORWARDED_FOR'))
						        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
						    else if(getenv('HTTP_X_FORWARDED'))
						        $ipaddress = getenv('HTTP_X_FORWARDED');
						    else if(getenv('HTTP_FORWARDED_FOR'))
						        $ipaddress = getenv('HTTP_FORWARDED_FOR');
						    else if(getenv('HTTP_FORWARDED'))
						       $ipaddress = getenv('HTTP_FORWARDED');
						    else if(getenv('REMOTE_ADDR'))
						        $ipaddress = getenv('REMOTE_ADDR');
						    else
						        $ipaddress = 'UNKNOWN';
						    return $ipaddress;
						}
						echo "Your IP is: ". get_client_ip(); ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<span style="float: right;">
				<?php
					$date = date("d-M-y");
					echo "Date: $date";
				?>
				</span>
			</div>
		</div>
	</div>
</section>

<a href="#" id="backtotop"><i class="fa fa-arrow-up" area-hidden="true"></i></a>
<!--=========== END FOOTER SECTION ================-->
<script src="//localhost/assembly/js/global.js"></script> 