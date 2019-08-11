<?php


namespace ExchangeRate\Model;


class CBRFRateProvider implements RateProviderInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new \Zend\Soap\Client(
            'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL'
        );
    }

    public function getRatesByDate($dateTime, $currencies = [])
    {
        $rates = [];
        $filterRates = count($currencies) > 0;
        $response = $this->client->GetCursOnDate([
            'On_date' => $dateTime
        ]);

        $root = new \SimpleXMLElement($response->GetCursOnDateResult->any);
        foreach($root->ValuteData->ValuteCursOnDate as $valuteCursOnDate) {
            if ($filterRates) {
                if (in_array($valuteCursOnDate->VchCode, $currencies)) {
                    $rate = new ExchangeRate();
                    $rate->dateTime = new \DateTime($dateTime);
                    $rate->currencyCode = (string) $valuteCursOnDate->VchCode;
                    $rate->rate = (float) $valuteCursOnDate->Vcurs;

                    $rates[] = $rate;
                }
            }
            else {
                $rate = new ExchangeRate();
                $rate->dateTime = new \DateTime($dateTime);
                $rate->currencyCode = $valuteCursOnDate->VchCode;
                $rate->rate = $valuteCursOnDate->Vcurs;

                $rates[] = $rate;
            }
        }

        return $rates;
    }
}