<?php
return array(
    'params' => array(
        'email' => 'brasil2014.tk@gmail.com',
        'application' => array(
            'autor' => 'Rafael J Torres',
            'description' => 'Arma tu quiniela y diviértete compitiendo con tus amigos de forma gratuita. Si quieres optar por el pote actívala cuanto antes, entre más actives tienes más posibilidades de ganar.'
        ),
        'facebook' => array(
            'user' => 'Quiniela Brasil 2014',
            'url' => 'https://www.facebook.com/groups/327953450686865/'
        ),
        'twitter' => array(
            'user' => 'citemve',
            'url' => 'https://twitter.com/citemve'
        ),
        'google' => array(
            'user' => 'citem.ve',
            'url' => 'https://plus.google.com/102459727855426273891'
        ),
        'pattern' => array(
            'cedula' => array(
                'MASK' => 'V-00.000.000',
                'CHARMAP' => array(
                    'V' => '[VE]',
                    '0' => '[0-9]'
                )
            ),
            'telefono' => array(
                'MASK' => '(0274)-999.9999',
                'CHARMAP' => array(
                    '0' => '[0]',
                    '2' => '[24]',
                    '7' => '[1-9]',
                    '4' => '[0-9]',
                    '9' => '[0-9]'
                )
            )
        ),
        // Patrones de GiiModule
        'GII' => array(
            'FK' => 'id_',
            'MAIL' => 'email',
            'PASS' => 'pass',
            'URL' => 'url_'
        )
    )
);
