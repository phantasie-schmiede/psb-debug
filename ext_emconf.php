<?php

$EM_CONF[$_EXTKEY] = [
    'author'           => 'Daniel Ablass',
    'author_email'     => 'dn@phantasie-schmiede.de',
    'category'         => 'misc',
    'clearCacheOnLoad' => true,
    'constraints'      => [
        'conflicts' => [
        ],
        'depends'   => [
            'php'   => '7.4-8.1',
            'typo3' => '11.5.0-11.5.99',
        ],
        'suggests'  => [
        ],
    ],
    'description'      => 'a collection of debugging tools',
    'state'            => 'stable',
    'title'            => 'PSbits | Debug',
    'version'          => '0.1.1',
];
