<?php

namespace Deployer;

desc('Remove Images Folder');
task('assets:clear:img', run('rm -rf public/img'));
