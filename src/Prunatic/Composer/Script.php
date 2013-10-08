<?php

namespace Prunatic\Composer;

class Script
{
    public static function install()
    {
        echo "Setting permissions\n";
        chmod('cache', 01777); // sticky bit enabled
        self::copyTwitterAssets();

    }

    public static function copyTwitterAssets()
    {
        echo "Copying assets\n";
        exec('cp -r vendor/twitter/bootstrap/dist/* web/.');
    }
}
