<?php

namespace FondOfOryx\Zed\InvoiceApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapper;
use FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeBridge;
use FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerBridge;
use FondOfOryx\Zed\InvoiceApi\InvoiceApiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class InvoiceApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainer
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeBridge
     */
    protected $invoiceFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapper
     */
    protected $transferMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\InvoiceApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperMock = $this->getMockBuilder(TransferMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(InvoiceApiToApiQueryContainerBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceFacadeMock = $this->getMockBuilder(InvoiceApiToInvoiceFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new class ($this->transferMapperMock) extends InvoiceApiBusinessFactory
        {
            /**
             * @var \FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface
             */
            protected $transferMapper;

            /**
             * @param \FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface $transferMapper
             */
            public function __construct(TransferMapperInterface $transferMapper)
            {
                $this->transferMapper = $transferMapper;
            }

            /**
             * @return \FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface
             */
            protected function createTransferMapper(): TransferMapperInterface
            {
                return $this->transferMapper;
            }
        };

        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateInvoiceApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([InvoiceApiDependencyProvider::QUERY_CONTAINER_API], [InvoiceApiDependencyProvider::FACADE_CREDIT_MEMO])
            ->willReturnOnConsecutiveCalls($this->apiQueryContainerMock, $this->invoiceFacadeMock);

        $this->businessFactory->createInvoiceApi();
    }
}
