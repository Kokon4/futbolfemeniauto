<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('application', 'futbol-femeni');
set('repository', 'https://github.com/Kokon4/futbolfemeniauto.git');

add('shared_files', ['.env']);
add('shared_dirs', ['storage']);
add('writable_dirs', ['storage','bootstrap/cache']);
set('keep_releases', 3);

// Hosts

host('34.203.217.182')
    ->set('remote_user', 'futboldeploy')
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('deploy_path', '/home/futboldeploy/futbol-femeni');

// Hooks

after('deploy:failed', 'deploy:unlock');
before('deploy:symlink', 'artisan:migrate');
