<?php 
    return [ 
        // 'client_id' => 'AXEbmWOh6BzFynnGD8rjxr-HCsbz_2gPvoJeJRTfnZpFluFhHvZSDHYgU1xcqLp8RGrxl8mTp-v_2g0G',
        // 'secret' => 'EJXhZaA7ml_lZu8e8XgBCFYztkukgMZPN8vI162ZI_JtmA2kOFPDeOfSyEGMLWstrBDnyjTW2KYJ3cn3',
        'settings' => array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 1000,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'FINE'
        ),
    ];