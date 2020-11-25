<?php

// AuthorBy: RyoDev

use Config\User;
use Client\Http;

foreach (['Config/User.php', 'Client/Http.php'] as $class) {
    require $class;
}

(function () {
    $User = new User;
    $Http = new Http;

    system('clear');
    echo "[+] Bot Chat [+]\n";
    main___:
    echo '> You: ';
    $message___ = trim(fgets(STDIN));

    $response___ = json_decode($Http->get('https://afara.my.id/api/v3/sim-simi', [
        'text' => $message___
    ], [
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Bearer ' . $User->token
    ]), true);

    if (isset($response___['response'])) {
        echo "> Bot: {$response___['response']} \n";
        goto main___;
    } else {
        echo (($response___['message'] ?? null) === 'Unauthenticated.' ? '[!] Invalid API Token, get a free API Token at afara.my.id' : $response___['error'] ?? 'Unknow error.');
    }
})();
