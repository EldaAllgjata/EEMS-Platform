<?php

$hash = '$2y$10$QbERMCiIKgtV4WvvdsWJBOnveVZX3c4l8bsoEwANBCP9NyQU99uiq';

if(password_verify('123456', $hash)){
    echo "Password eshte 123456";
}else{
    echo "Password nuk eshte 123456";
}

?>