<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector\Communication\Plugin\QuoteExtension;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CustomerQuoteConnector\Communication\CustomerQuoteConnectorCommunicationFactory;
use FondOfOryx\Zed\CustomerQuoteConnector\Dependency\Facade\CustomerQuoteConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerQuoteConnector\Persistence\CustomerQuoteConnectorRepository;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerQuoteExpanderPluginTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\CustomerTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerQuoteConnector\Communication\CustomerQuoteConnectorCommunicationFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerQuoteConnectorCommunicationFactory $factoryMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerQuoteConnector\Persistence\CustomerQuoteConnectorRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerQuoteConnectorRepository|MockObject $repositoryMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerQuoteConnector\Dependency\Facade\CustomerQuoteConnectorToCustomerFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerQuoteConnectorToCustomerFacadeInterface $customerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerQuoteConnector\Communication\Plugin\QuoteExtension\CustomerQuoteExpanderPlugin
     */
    protected CustomerQuoteExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(CustomerQuoteConnectorCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerQuoteConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(CustomerQuoteConnectorToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerQuoteExpanderPlugin();
        $this->plugin->setFactory($this->factoryMock);
        $this->plugin->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $customerReference = 'foo';
        $idCustomer = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn($idCustomer);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerFacade')
            ->willReturn($this->customerFacadeMock);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->with(
                static::callback(
                    static fn (
                        CustomerTransfer $customerTransfer
                    ): bool => $customerTransfer->getIdCustomer() === $idCustomer
                ),
            )->willReturn($this->customerTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }

    /**
     * @depends testExpand
     *
     * @return void
     */
    public function testExpandWithCachedCustomer(): void
    {
        $customerReference = 'foo';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::never())
            ->method('getIdCustomerByCustomerReference');

        $this->factoryMock->expects(static::never())
            ->method('getCustomerFacade');

        $this->customerFacadeMock->expects(static::never())
            ->method('getCustomer');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithPredefinedCustomer(): void
    {
        $customerReference = 'foo';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::never())
            ->method('getIdCustomerByCustomerReference');

        $this->factoryMock->expects(static::never())
            ->method('getCustomerFacade');

        $this->quoteTransferMock->expects(static::never())
            ->method('setCustomer');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithInvalidCustomerReference(): void
    {
        $customerReference = 'bar';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn(null);

        $this->factoryMock->expects(static::never())
            ->method('getCustomerFacade');

        $this->customerFacadeMock->expects(static::never())
            ->method('getCustomer');

        $this->quoteTransferMock->expects(static::never())
            ->method('setCustomer');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithError(): void
    {
        $idCustomer = 2;
        $customerReference = 'rab';

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn($idCustomer);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerFacade')
            ->willReturn($this->customerFacadeMock);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willThrowException(new Exception());

        $this->quoteTransferMock->expects(static::never())
            ->method('setCustomer');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }
}
