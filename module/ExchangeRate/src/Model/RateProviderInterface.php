<?php


namespace ExchangeRate\Model;


interface RateProviderInterface
{
    public function getRatesByDate($dateTime, $currencies);
}