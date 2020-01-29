<?php
require_once 'config/secure.php';
require_once 'logic/ApplicationCreator.php';

echo (new ApplicationCreator())->create()->printModelNo();

?>