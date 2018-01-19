<!-- Footer -->
<footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
	<div class="w3-row-padding">
		<div class="w3-col s4">
			<h4>Contact</h4>
			<p>Questions? Go ahead.</p>
			<form action="/contact.php" method="post">
				<p><input class="w3-input w3-border" type="text" placeholder="Name" name="name" required></p>
				<p><input class="w3-input w3-border" type="text" placeholder="Email" name="email" required></p>
				<p><input class="w3-input w3-border" type="text" placeholder="Subject" name="subject" required></p>
				<p><input class="w3-input w3-border" type="text" placeholder="Message" name="message" required></p>
				<button type="submit" class="w3-button w3-block w3-black">Send</button>
			</form>
		</div>

		<div class="w3-col s4">
			<h4> Language </h4>
			<p><a href="../language.php?lang=de"> Deutsch</a> </p>
			<p><a href="../language.php?lang=en"> English</a> </p>

			<h4>Admin</h4>
			<p><a href="../admin/AdminLogin.php"> Login </a> </p>
		</div>

		<div class="w3-col s4 w3-justify">
			<h4>Store</h4>
			<p><i class="fa fa-fw fa-map-marker"></i> Cars</p>
			<p><i class="fa fa-fw fa-phone"></i> +41 78 656 21 21</p>
			<p><i class="fa fa-fw fa-envelope"></i> cars@cars.com</p>
			<br>
			<i class="fa fa-facebook-official w3-hover-opacity w3-large"></i>
			<i class="fa fa-instagram w3-hover-opacity w3-large"></i>
			<i class="fa fa-snapchat w3-hover-opacity w3-large"></i>
			<i class="fa fa-twitter w3-hover-opacity w3-large"></i>
		</div>
	</div>
</footer>

<div class="w3-black w3-center w3-padding-24">Cars <?php echo date('y')?></div>