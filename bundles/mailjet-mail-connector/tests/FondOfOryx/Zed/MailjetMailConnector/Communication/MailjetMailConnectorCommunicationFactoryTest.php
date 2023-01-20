<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferCollectionMapperInterface;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesTransferMapperInterface;

class MailjetMailConnectorCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Communication\MailjetMailConnectorCommunicationFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factory = new MailjetMailConnectorCommunicationFactory();
    }

    /**
     * @return void
     */
    public function testCreateMailjetTemplateVariablesItemsMapper(): void
    {
        static::assertInstanceOf(
            MailjetTemplateVariablesTransferCollectionMapperInterface::class,
            $this->factory->createMailjetTemplateVariablesItemsMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateMailjetTemplateVariablesPaymentsMapper(): void
    {
        static::assertInstanceOf(
            MailjetTemplateVariablesTransferCollectionMapperInterface::class,
            $this->factory->createMailjetTemplateVariablesPaymentsMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateMailjetTemplateVariablesAddressMapper(): void
    {
        static::assertInstanceOf(
            MailjetTemplateVariablesTransferMapperInterface::class,
            $this->factory->createMailjetTemplateVariablesAddressMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateMailjetTemplateVariablesCalculatedDiscountsMapper(): void
    {
        static::assertInstanceOf(
            MailjetTemplateVariablesTransferCollectionMapperInterface::class,
            $this->factory->createMailjetTemplateVariablesCalculatedDiscountsMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateMailjetTemplateVariablesCustomerMapper(): void
    {
        static::assertInstanceOf(
            MailjetTemplateVariablesTransferMapperInterface::class,
            $this->factory->createMailjetTemplateVariablesCustomerMapper(),
        );
    }
}
