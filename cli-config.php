<?php
require_once "setup.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);