<?php
namespace Deployer;

use Dotenv\Dotenv;

require 'recipe/laravel.php';

// Load .env
if (file_exists(__DIR__.'/.env')) {
    require_once __DIR__.'/vendor/autoload.php';

    Dotenv::createImmutable(__DIR__)->load();
}

// Config

set('application', 'FIMEats');
set('deploy_path', '/var/www/fimeats');
set('repository', 'git@github.com:iksaku/FIMEats.git');
set('dotenv', '{{current_path}}/.env');

// Hosts

host('fimeats.jorgeglz.io')
    ->setHostname(env('DEPLOY_HOST'))
    ->setRemoteUser(env('DEPLOY_USER'));

// Tasks

before('deploy:publish', function () {
    // Create DB and import menus
    artisan('import:menus', ['skipIfNoEnv'])();

    // Upload assets built on CI
    upload(
        [
            'public/css',
            'public/js',
            'public/mix-manifest.json',
        ],
        '{{release_path}}/public'
    );
});

after('deploy:failed', 'deploy:unlock');
