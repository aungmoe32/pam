<?php
return [
    'filesystems' => [
        'default' => 'local',

        'disks' => [
            'local' => [
                'driver' => 'local',
                'root' => APP_ROOT.'/storage',
            ],
        ]
    ]
];
