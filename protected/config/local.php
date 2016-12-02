<?php
return CMap::mergeArray(require_once ('common.php'),
    array(
        'modules' => array(
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => 'root'
            )
        ),
        'components' => array(
            'db' => array(
                'class' => 'CDbConnection',
                'connectionString' => 'mysql:host=localhost;dbname=fifa',
                'username' => 'root',
                'password' => 'root',
                'charset' => 'utf8'
            ),
            /*
            'cache' => array(
                'class' => 'CFileCache'
            )
            */
        )
    ));
