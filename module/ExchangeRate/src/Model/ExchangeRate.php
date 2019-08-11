<?php


namespace ExchangeRate\Model;


class ExchangeRate
{
    public $dateTime;
    public $currencyCode;
    public $rate;

    public function exchangeArray(array $data)
    {
        $this->dateTime = new \DateTime($data['dateTime'] ?? null);
        $this->currencyCode = $data['currencyCode'] ?? null;
        $this->rate = $data['rate'] ?? null;
    }
}