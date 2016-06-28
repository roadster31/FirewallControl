<?php
/*************************************************************************************/
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE      */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

/**
 * Created by Franck Allimant, CQFDev <franck@cqfdev.fr>
 * Date: 28/06/2016 11:48
 */
namespace FirewallControl\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thelia\Model\FormFirewallQuery;

class Clear extends Command
{
    protected function configure()
    {
        $this
            ->setName("formfirewall:clear")
            ->setDescription("Delete all form firewall entries")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        FormFirewallQuery::create()->deleteAll();

        $output->writeln("Form firewall has been cleared.");
    }
}
