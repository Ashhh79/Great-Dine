<?php include('config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container border-bottom">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
<section class="section1">
	<div class="container">
		<div class="contactinfo">
			<div>
				<h2>Contact Info!</h2>
				<ul class="info">
					<li>
						<span><img src="<?php echo SITEURL?>css/location.png" width="5%"></span><br>
						<span>123 Main Street, <br>
							New Delhi, <br>
							India 100001.<br></span>
					</li>
					<li>
						<span><img src="<?php echo SITEURL?>css/mail.png" width="5%"></span><br>
						<span>abcdefg@gmail.com<br></span>
					</li>
					<li>
						<span><img src="<?php echo SITEURL?>css/call.png" width="5%"></span><br>
						<span>+91-8779108725 <br></span>
					</li>
				</ul>
				<ul class="sci">
					<li><a href="#"><img src="1.png"></a></li>
					<li><a href="#"><img src="2.png"></a></li>
					<li><a href="#"><img src="3.png"></a></li>
					<li><a href="#"><img src="4.png"></a></li>
					<li><a href="#"><img src="5.png"></a></li>
				</ul>
			</div>
		</div>
		<div class="contactForm">
			<h2>Send a Message.</h2>
			<div class="formBox">
				<div class="inputBox w50">
					<input type="text" name="" required>
					<span>First Name</span>
				</div>
				<div class="inputBox w50">
					<input type="text" name="" required>
					<span>Last Name</span>
				</div>
				<div class="inputBox w50">
					<input type="text" name="" required>
					<span>Email Address</span>
				</div>
				<div class="inputBox w50">
					<input type="text" name="" required>
					<span>Mobile Number</span>
				</div>
				<div class="inputBox w100">
					<textarea name="" required></textarea>
					<span>Write your message here...</span>
				</div>
				<div>
					<input type="submit" value="Send" name="">
				</div>
			</div>
		</div>
	</div>
</section>



<?php include('partials-front/footer.php');?>