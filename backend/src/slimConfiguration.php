<?php

namespace src;

function slimConfiguration() {
    $configuration = [
        'settings' => [
            'displayErrorsDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
        ],
    ];
    return new \Slim\Container($configuration);
}