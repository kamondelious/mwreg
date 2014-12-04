<?php
require_once 'header.php';
page_header('Mech Warfare Registration -- Reset Password');
?><div class='content'>
<?php
if ($reset_message) {
    ?><div class='error'><?php echo htmlquote($reset_message); ?></div><?php
}
?><div class='text'>
Enter a new password (twice) to proceed. Remember to choose a secure 
password, like a phrase of words that is easy to remember. The minimum 
password length is 6 characters, and the maximum password length is 72 
characters.
</div>
<form method='post'>
<div class='formfield'><span class='label'>Password:</span><span class='field'><input type='password' name='password'/></span></div>
<div class='formfield'><span class='label'>Again:</span><span class='field'><input type='password' name='password2'/></span></div>
<div class='formfield'><span class='label'>&nbsp;</span><span class='field'><button name='submit'>Reset Password</button></span></div>
<input type='hidden' name='email' value='<?php echo htmlquote($_REQUEST['email']); ?>'/>
<input type='hidden' name='code' value='<?php echo htmlquote($_REQUEST['code']); ?>'/>
</div>
<div class='footer'>
</div>
</body>
