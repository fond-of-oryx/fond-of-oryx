<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication;

use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesItemMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesPaymentMapper;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class MailjetMailConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesItemMapper
     */
    public function createMailjetTemplateVariablesItemMapper(): MailjetTemplateVariablesItemMapper
    {
        return new MailjetTemplateVariablesItemMapper();
    }

    public function createMailjetTemplateVariablesPaymentMapper(): MailjetTemplateVariablesPaymentMapper
    {
        return new MailjetTemplateVariablesPaymentMapper();
    }
}
