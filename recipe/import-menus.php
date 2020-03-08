<?php

namespace Deployer;

desc('Import project\'s menus');
task('artisan:import:menus', artisan('import:menus -q', ['skipIfNoEnv']));
