<?php

use Mmb\Calling\ExtrArchive;
use Mmb\Compile\Compiler;

if(file_exists(__DIR__ . '/extractMe.php'))
    file_put_contents(__DIR__ . '/extractMe.php', "<?php // None");
include __DIR__ . '/load.php';

// Extr settings
$settings = [
    'enabled' => true,
    'output' => __DIR__ . '/Output/extractMe.php',
    'ignores' => [
        __FILE__,
        __DIR__ . '/Output',
        __DIR__ . '/.backup',
    ],

    'backup' => __DIR__ . '/.backup',
    'backup_ignores' => [
        __DIR__ . '/Output',
        __DIR__ . '/.backup',
    ],
    'backup_as' => 'Y-m-d-H',
];





if(@$argv[1] == '-c')
{
    Compiler::compile(__DIR__ . "/App", __DIR__ . "/Handles", __DIR__ . "/Configs");
    if($settings['enabled'])
    {
        ExtrArchive::archiveFiles($settings['output'], __DIR__, ignores:$settings['ignores']);
    }
    if(@$settings['backup'])
    {
        ExtrArchive::zipBackup($settings['backup'], $settings['backup_as'], __DIR__, $settings['backup_ignores']);
    }
}


else
{
    while(true)
    {
        echo str_repeat("-", 30), "\n";
        echo "\n+ Press enter to start compiling (Ctrl+C to exit) ...";
        readline();
        echo str_repeat("-", 30), "\n";
        system("php \"$argv[0]\" -c");
        echo "\n" . str_repeat("-", 30), "\n";
    }
}
