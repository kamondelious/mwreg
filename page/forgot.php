<?php
require_once 'header.php';
page_header('Mech Warfare Registration -- Forgot Password');
?><div class='content'>
<?php
if ($forgot_message) {
?><div class='error'>
<?php echo htmlquote($forgot_message); ?>
</div><?php
}
?><div class='heading'>
Forgot your e-mail address?
</div>
<div class='text'>
Enter your user name to be sent a reminder of the e-mail address you used when signing up.
</div>
<form method='post'>
<div class='formfield'><span class='label'>Name:</span><span class='field'><input type='text' id='name' name='name' value='<?php echo htmlquote(@$_POST['name']); ?>' /></span></div>
<div class='formfield'><span class='label'>&nbsp;</span><span class='field'><button id='submit_name' name='submit_name'>Find Email</button></span></div>
</form>
<div class='heading'>
Forgot your password?
</div>
<div class='text'>
Enter your e-mail address to be sent a link that you can click to re-set your password.
</div>
<form method='post'>
<div class='formfield'><span class='label'>E-mail:</span><span class='field'><input type='text' id='email' name='email' value='<?php echo htmlquote(@$_POST['email']); ?>' /></span></div>
<div class='formfield'><span class='label'>&nbsp;</span><span class='field'><button id='submit_email' name='submit_email'>Reset Password</button></span></div>
</form>
</div>
</div class='footer'>
</div>
</body>
