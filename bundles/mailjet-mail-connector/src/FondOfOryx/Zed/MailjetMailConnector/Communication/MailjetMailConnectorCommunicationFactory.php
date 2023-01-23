<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication;

use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesAddressMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCalculatedDiscountsMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCustomerMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesItemsMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesPaymentsMapper;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferCollectionMapperInterface;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferMapperInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class MailjetMailConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferCollectionMapperInterface
     */
    public function createMailjetTemplateVariablesItemsMapper(): MailjetTemplateVariablesTransferCollectionMapperInterface
    {
        return new MailjetTemplateVariablesItemsMapper();
    }

    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferCollectionMapperInterface
     */
    public function createMailjetTemplateVariablesPaymentsMapper(): MailjetTemplateVariablesTransferCollectionMapperInterface
    {
        return new MailjetTemplateVariablesPaymentsMapper();
    }

    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferMapperInterface
     */
    public function createMailjetTemplateVariablesAddressMapper(): MailjetTemplateVariablesTransferMapperInterface
    {
        return new MailjetTemplateVariablesAddressMapper();
    }

    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferCollectionMapperInterface
     */
    public function createMailjetTemplateVariablesCalculatedDiscountsMapper(): MailjetTemplateVariablesTransferCollectionMapperInterface
    {
        return new MailjetTemplateVariablesCalculatedDiscountsMapper();
    }

    /**
     * @return \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferMapperInterface
     */
    public function createMailjetTemplateVariablesCustomerMapper(): MailjetTemplateVariablesTransferMapperInterface
    {
        return new MailjetTemplateVariablesCustomerMapper();
    }
}
