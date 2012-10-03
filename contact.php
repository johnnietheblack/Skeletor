<?php
/*
Template Name: Contact
*/
$error = false;

if(isset($_POST['sub_contact'])){
	$error_message = '';
	
	if($_POST['contact_name'] == ''){ 
		$error = true;
		$error_message .= "<p class='error'>Please enter your name</p>";
	}elseif(!filter_var(trim($_POST['contact_email']),FILTER_VALIDATE_EMAIL)){
		$error = true;
		$error_message .= "<p class='error'>Please enter a valid email address</p>";
	}elseif(!trim($_POST['contact_message'])){
		$error = true;
		$error_message .= "<p class='error'>Please enter a message</p>";
	}else{ 
		$mailto = '';
		if($mailto == '') {
			die('Please set up your email in Skeletor');
		}
		$email = mail('',trim($_POST['contact_name'])." sent you a message from ".get_option("blogname"),stripslashes(trim($_POST['contact_message']))."\r\n\r\n".'Reply to: '.trim($_POST['contact_email']),"From: ".trim($_POST['contact_name'])." <".trim($_POST['contact_email']).">\r\nReply-To:".trim($_POST['contact_email']));
		
		// redirect so that POST info isn't saved
		header("Location: /contact/?success=true");
		exit;
	}
}
?>

<?php get_header(); ?>

<div id="main">
	<h2>Contact Us</h2>
	
	<div id="contact_form">
		<?php if(isset($_GET['success'])) { ?>
			<p class="success"><strong>Message succesfully sent. We'll get back to you shortly!</strong></p>
		<?php } elseif($error) { ?>
			<?php echo urldecode($error_message); ?>
		<?php } ?>
		
		<form name="contact" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="form">
			<div class="section">
				<label for="contact_name">Your name:</label>
				<input type="text" name="contact_name" value="<?php if(isset($_POST['contact_name'])) { echo stripslashes($_POST['contact_name']);} ?>" />
			</div>
			<div class="section">
				<label for="contact_email">Your email:</label>
				<input type="email" name="contact_email" value="<?php if(isset($_POST['contact_email'])) { echo stripslashes($_POST['contact_email']);} ?>" />
			</div>
			<div class="section">
				<label for="contact_message">Message:</label>
				<textarea name="contact_message"><?php if(isset($_POST['contact_message'])) { echo stripslashes($_POST['contact_message']);} ?></textarea>
			</div>
			<div class="section">
				<input type="submit" name="sub_contact" value="Send" class="red_button" />
			</div>
		</form>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>