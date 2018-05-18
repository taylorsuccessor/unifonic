<?php

return [
    'databaseType'=>'sqlite',
    'mysql'=>[
        'host'=>'localhost',
        'username'=>'root',
        'password'=>'unifonic',
        'database'=>'unifonic'
    ],
    'sqlite'=>[
        'location'=>_BASEFILE_.'/sqliteDb.sql',
        'database'=>'unifonic',
    ]
];