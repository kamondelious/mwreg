<?php
require_once('header.php');
page_header('Mech Warfare Registration -- Mechs');
?>
<div class='content'>
<?php
$_mechid = (int)@$_GET['mechid'];
if ($_mechid) {
} else {
    $allmechs = get_all_mechs();
}
</div>
<div class='footer'>
</div>
</body>
