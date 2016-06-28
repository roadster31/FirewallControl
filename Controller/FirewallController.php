<?php
/*************************************************************************************/
/*                                                                                   */
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*************************************************************************************/

namespace FirewallControl\Controller;

use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Model\FormFirewallQuery;
use Thelia\Tools\URL;

/**
 * Redsys payment module
 *
 * @author Franck Allimant <franck@cqfdev.fr>
 */
class FirewallController extends BaseAdminController
{
    public function clearEntry($entryId)
    {
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, 'FirewallControl', AccessManager::DELETE)) {
            return $response;
        }

        if (null !== $record = FormFirewallQuery::create()->findPk($entryId)) {
            $record->delete();
        }

        return $this->generateRedirect(URL::getInstance()->absoluteUrl('/admin/module/FirewallControl'));
    }

    public function clearAll()
    {
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, 'FirewallControl', AccessManager::DELETE)) {
            return $response;
        }

        FormFirewallQuery::create()->deleteAll();

        return $this->generateRedirect(URL::getInstance()->absoluteUrl('/admin/module/FirewallControl'));
    }

}
