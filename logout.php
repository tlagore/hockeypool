<?php
setcookie('cur_login', null, time()-3600, '/');
header('Location: /hockeypool');
?>