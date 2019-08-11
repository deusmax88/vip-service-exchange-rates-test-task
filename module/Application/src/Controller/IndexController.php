<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $client = new \Zend\Soap\Client(
            'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL'
        );

        $dateTime = (new \DateTime())->format("Y-m-d\TH:i:s");

        $response = $client->GetCursOnDate([
            'On_date' => $dateTime
        ]);

//        var_dump($response);
        $root = new \SimpleXMLElement($response->GetCursOnDateResult->any);
        foreach($root->ValuteData->ValuteCursOnDate as $valuteCursOnDate) {
            echo join(',', [
                $valuteCursOnDate->VchCode,
                $valuteCursOnDate->Vcurs
            ]);
            echo "<br />";
        }

        die();

        return new ViewModel();
    }
}
