<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApi;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidator;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiDependencyProvider;
use FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepository;
use Spryker\Zed\Kernel\Container;

class ErpInvoiceApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiBusinessFactory
     */
    protected $erpInvoiceApiBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceFacadeMock = $this->getMockBuilder(ErpInvoiceApiToErpInvoiceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ErpInvoiceApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpInvoiceApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiBusinessFactory = new ErpInvoiceApiBusinessFactory();
        $this->erpInvoiceApiBusinessFactory->setContainer($this->containerMock);
        $this->erpInvoiceApiBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpInvoiceApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ErpInvoiceApiDependencyProvider::QUERY_CONTAINER_API], [ErpInvoiceApiDependencyProvider::FACADE_ERP_INVOICE])
            ->willReturnOnConsecutiveCalls($this->apiQueryContainerMock, $this->erpInvoiceFacadeMock);

        static::assertInstanceOf(
            ErpInvoiceApi::class,
            $this->erpInvoiceApiBusinessFactory->createErpInvoiceApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpInvoiceApiValidator(): void
    {
        static::assertInstanceOf(
            ErpInvoiceApiValidator::class,
            $this->erpInvoiceApiBusinessFactory->createErpInvoiceApiValidator(),
        );
    }
}
