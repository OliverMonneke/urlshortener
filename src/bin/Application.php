<?php

use Codersquad\Urlshortener\Command\InstallCommand;
use Symfony\Component\Console\Application;

require_once(__DIR__.'/../../vendor/autoload.php');

$application = new Application();
$application->add(new InstallCommand());
$application->run();
