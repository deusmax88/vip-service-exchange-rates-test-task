<?php
namespace ExchangeRate;

use ExchangeRate\Controller\ExchangeRateController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'exchange-rate' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/exchange-rate',
                    'defaults' => [
                        'controller' => ExchangeRateController::class,
                        'action'     => 'index',
                    ],
                ],
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'exchange-rate' => __DIR__. '/../view/'
        ]
    ]
];