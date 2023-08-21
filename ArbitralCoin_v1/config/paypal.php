<?php 
return [ 
    'client_id' => 'Abq2ySBKIi7dK9kbrwv2Tr6xDgQ7xymoHbEtD3nPVfqNwvbxtV5CT60C3TqPxwGXoZczTAcYW71-ozwP',
	'secret' => 'Abq2ySBKIi7dK9kbrwv2Tr6xDgQ7xymoHbEtD3nPVfqNwvbxtV5CT60C3TqPxwGXoZczTAcYW71-ozwP',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];