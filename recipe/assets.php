<?php

namespace Deployer;

desc('Remove Images Folder');
task('assets:clear:img', function () {
    run('rm -rf {{release_path}}/public/img/');
});
