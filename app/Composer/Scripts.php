<?php

namespace App\Composer;

use Composer\Script\Event;

class Scripts
{
    /*
     * Stops propagation of Composer event if isn't on development environment
     *
     * This is useful to prevent running scripts for third-party packages
     * without the need to intercept previous event scripts that should be run
     * during non-development environments as well.
     *
     * An example of this is the "post-update-cmd" event:
     *  1. Must execute laravel's postUpdate script on any environment.
     *  2. Should execute cghooks for development environments only.
     *  3. Must execute ide-helper commands for development purposed, but doesn't really
     *     help in production environments.
     * With this script, events that are supposed to execute "afterwards" will
     * be prevented if not in a development environment, making events faster during
     * production-like environments.
     */
    public static function devOnly(Event $event)
    {
        if (!$event->isDevMode()) {
            $event->stopPropagation();
        }
    }
}
