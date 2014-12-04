<?php
require_once 'header.php';
page_header('Mech Warfare Registration User Profile');
?>
<div class='content'>
<?php if ($profile_error) {
    echo "<div class='error'>".htmlquote($profile_error)."</div>\n";
}?>
<div class='heading'>Change Name</div>
<div class='text'>
You can change your name up to three times in the period of a month. The new name must 
be a valid name that is not already in use by someone else. An e-mail will be sent to 
the account confirming the name change.
</div>
<form method='post'>
<?php echo get_csrf_input(); ?>
<div class='formfield'><span class='label'>Name:</span><span class='field'><input type='text' name='name' value='<?php echo htmlquote($user['name']); ?>'/></span>
<?php
    if ($name_ok) {
        echo "<span class='ok'>".htmlquote($name_ok)."</span>";
    }
?>
</div>
<div class='formfield'><span class='label'>&nbsp;</span><span class='field'><button name='submit' value='name'>Change Name</button></span></div>
</form>
<div class='heading'>Change E-mail</div>
<div class='text'>
You can change the e-mail address up to three times in the period of a month. A new 
e-mail verification message will be sent to the new address, and a confirmation message 
will be sent to the old address. You will not be able to log in until you have confirmed 
the new e-mail address.
</div>
<form method='post'>
<?php echo get_csrf_input(); ?>
<div class='formfield'><span class='label'>E-mail:</span><span class='field'><input type='text' name='email' value='<?php echo htmlquote($user['email']); ?>'/></span>
<?php
    if ($email_ok) {
        echo "<span class='ok'>".htmlquote($email_ok)."</span>";
    }
?>
</div>
<div class='formfield'><span class='label'>Again::</span><span class='field'><input type='text' name='email2' value='<?php echo htmlquote($user['email']); ?>'/></span></div>
<div class='formfield'><span class='label'>&nbsp;</span><span class='field'><button name='submit' value='email'>Change E-mail</button></span></div>
</form>
<div class='heading'>Change Password</div>
<div class='text'>
You must enter the current password, and then enter the new password twice, to avoid typos.
A password must be between 6 and 72 characters long, after removing leading/trailing spaces.
</div>
<form method='post'>
<?php echo get_csrf_input(); ?>
<div class='formfield'><span class='label'>Current Password:</span><span class='field'><input type='password' name='curpw' value=''/></span></div>
<div class='formfield'><span class='label'>New Password:</span><span class='field'><input type='password' name='newpw' value=''/></span>
<?php
    if ($password_ok) {
        echo "<span class='ok'>".htmlquote($password_ok)."</span>";
    }
?>
</div>
<div class='formfield'><span class='label'>New Again:</span><span class='field'><input type='password' name='newpw2' value=''/></span></div>
<div class='formfield'><span class='label'>&nbsp;</span><span class='field'><button name='submit' value='password'>Change Password</button></span></div>
</form>
</div>
<div class='footer'></div>
</body>
