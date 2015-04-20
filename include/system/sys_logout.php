<?php
$aut = SYSLogin::instanciar();
$aut->logout();
header("Location: ".baseURL.'login/');