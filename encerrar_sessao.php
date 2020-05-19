<?php
setcookie('login', "", time()-3600);
setcookie('name', "", time()-3600);
setcookie('email', "", time()-3600);
setcookie('description', "", time()-3600);
setcookie('id', "", time()-3600);

header('Location: entrar.php?msg=logout'); 