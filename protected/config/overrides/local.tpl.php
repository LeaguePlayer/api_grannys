<?php
    return array(
        'components' => array(
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=apigrannys_app',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
                'tablePrefix' => 'tbl_',
            ),
        ),
    );
