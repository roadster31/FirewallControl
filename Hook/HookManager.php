<?php
/*************************************************************************************/
/*                                                                                   */
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*************************************************************************************/

namespace FirewallControl\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class HookManager extends BaseHook
{
    public function onConfigurationSystemBottom(HookRenderEvent $event)
    {
        $event->add(
            $this->render('firewall-control/configuration-menu-entry.html')
        );
    }

    public function onModuleConfigure(HookRenderEvent $event)
    {
        $event->add(
            $this->render('firewall-control/module-configuration.html')
        );
    }
}
