<?php


namespace ExchangeRate;


use ExchangeRate\Model\CBRFRateProvider;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ConfigProviderInterface
{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\ExchangeRateTable::class => function($container) {
                    $tableGateway = $container->get(Model\ExchangeRateTableGateway::class);
                    return new Model\ExchangeRateTable($tableGateway);
                },
                Model\ExchangeRateTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\ExchangeRate());
                    return new TableGateway('exchangeRate', $dbAdapter, null, $resultSetPrototype);
                },
                Model\CBRFRateProvider::class => InvokableFactory::class
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\ExchangeRateController::class => function ($container) {
                    return new Controller\ExchangeRateController(
                        $container->get(Model\CBRFRateProvider::class),
                        $container->get(Model\ExchangeRateTable::class)
                    );
                }
            ]
        ];
    }
}