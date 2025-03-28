<?php
$hashed_password = password_hash("admin123", PASSWORD_BCRYPT);
echo "Hashed Password: " . $hashed_password;
?>
