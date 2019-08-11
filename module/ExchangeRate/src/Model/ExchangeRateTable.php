<?php


namespace ExchangeRate\Model;

use Zend\Db\Adapter\Exception\InvalidQueryException;
use Zend\Db\TableGateway\TableGatewayInterface;

class ExchangeRateTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function saveRate(ExchangeRate $exchangeRate)
    {
        $data = [
            'dateTime' => $exchangeRate->dateTime->format('Y-m-d H:i:s'),
            'currencyCode' => $exchangeRate->currencyCode,
            'rate' => $exchangeRate->rate
        ];

        try {
            $this->tableGateway->insert($data);
        }
        catch (InvalidQueryException $e) {

        }

        return;
    }

    public function saveAll(array $exchangeRates)
    {
        foreach($exchangeRates as $exchangeRate) {
            $this->saveRate($exchangeRate);
        }

        return;
    }
}