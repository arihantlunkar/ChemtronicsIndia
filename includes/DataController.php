<?php
require_once 'secure.php';
require_once 'logic/ApplicationCreator.php';

echo (new ApplicationCreator())->create()->printModelNo();

?>