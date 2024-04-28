<?php
$salt = 'randomsaltasd123';
function hashPasswordWithSalt($password, $salt)
{
    $password = hash('sha256', $password . $salt);
    return $password;
}
