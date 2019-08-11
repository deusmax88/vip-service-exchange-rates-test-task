<?php

namespace ExchangeRate\Controller;

use ExchangeRate\Model\RateProviderInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ExchangeRateController extends AbstractActionController
{
    protected $rateProvider;

    protected $rateTable;

    public function __construct(RateProviderInterface $rateProvider, $rateTable)
    {
        $this->rateProvider = $rateProvider;
        $this->rateTable = $rateTable;
    }

    public function indexAction()
    {
        $dateTime = (new \DateTime())->format("Y-m-d\TH:i:s");
        $rates = $this->rateProvider->getRatesByDate($dateTime, ['USD', 'EUR']);
        $this->rateTable->saveAll($rates);
        $storedRates = $this->rateTable->fetchAll();

        return new ViewModel([
            'exchangeRates' => $storedRates
        ]);
    }
}