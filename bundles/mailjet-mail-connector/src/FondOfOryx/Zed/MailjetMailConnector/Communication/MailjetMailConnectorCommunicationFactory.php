<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication;

use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetRequestAddressMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetRequestAddressMapperInterface;
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

    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesPaymentMapper
     */
    public function createMailjetTemplateVariablesPaymentMapper(): MailjetTemplateVariablesPaymentMapper
    {
        return new MailjetTemplateVariablesPaymentMapper();
    }

    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetRequestAddressMapperInterface
     */
    public function createMailjetRequestAddressMapper(): MailjetRequestAddressMapperInterface
    {
        return new MailjetRequestAddressMapper();
    }
}
