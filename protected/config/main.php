<?php
return CMap::mergeArray(require_once ('common.php'),
    array(
        'components' => array(
            'db' => array(
                'class' => 'CDbConnection',
                'connectionString' => 'mysql:host=mysql.nixiweb.com;dbname=u621366974_fifa',
                'username' => 'u621366974',
                'password' => 'u621366974',
                'charset' => 'utf8'
            ),
            'cache' => array(
                'class' => 'CFileCache'
            )
        )
    ));
