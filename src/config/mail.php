<?php

return [
    'driver' =>'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => [
        'address' => 'info@121round.com',
        'name' => '121channel'
    ],
    'encryption' => 'tls',
    'username' => 'info@121round.com',
    'password' => 'adrylegnmumissbm',
    'sendmail' => '/usr/sbin/sendmail -bs',
];
