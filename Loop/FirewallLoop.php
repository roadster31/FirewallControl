<?php
/*************************************************************************************/
/*                                                                                   */
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*************************************************************************************/

namespace FirewallControl\Loop;

use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Form\TheliaFormFactoryInterface;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Form\FirewallForm;
use Thelia\Model\FormFirewall;
use Thelia\Model\FormFirewallQuery;

class FirewallLoop extends BaseLoop implements PropelSearchLoopInterface
{
    public function buildModelCriteria()
    {
        $search = FormFirewallQuery::create();

        if (null !== $id = $this->getId()) {
            $search->filterById($id, Criteria::IN);
        }

        if (null !== $ip = $this->getIpAddress()) {
            $search->filterByIpAddress($ip, Criteria::IN);
        }

        if (null !== $form = $this->getFormName()) {
            $search->filterByFormName($form, Criteria::IN);
        }

        $search->orderByUpdatedAt(Criteria::DESC);

        return $search;
    }

    public function parseResults(LoopResult $loopResult)
    {
        /** @var FormFirewall $item */
        foreach ($loopResult->getResultDataCollection() as $item) {
            $loopResultRow = new LoopResultRow($item);

            $loopResultRow
                ->set('ID', $item->getId())
                ->set('IP_ADDRESS', $item->getIpAddress())
                ->set('FORM_NAME', $item->getFormName())
                ->set('ATTEMPTS', $item->getAttempts())
                ->set('DATE', $item->getUpdatedAt())
            ;

            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }

    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument("id"),
            Argument::createAnyListTypeArgument("ip_address"),
            Argument::createAnyListTypeArgument("form_name")
        );
    }
}