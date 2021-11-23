<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisherInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher\ErpInvoicePageSearchUnpublisherInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManager;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainer;
use Spryker\Zed\Kernel\Container;

class ErpInvoicePageSearchBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchBusinessFactory
     */
    protected $erpInvoicePageSearchBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManager
     */
    protected $erpInvoicePageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainer
     */
    protected $erpInvoicePageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface
     */
    protected $erpInvoicePageSearchToUtilEncodingServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchEntityManagerMock = $this->getMockBuilder(ErpInvoicePageSearchEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchQueryContainerMock = $this->getMockBuilder(ErpInvoicePageSearchQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToUtilEncodingServiceMock = $this->getMockBuilder(ErpInvoicePageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchBusinessFactory = new ErpInvoicePageSearchBusinessFactory();
        $this->erpInvoicePageSearchBusinessFactory->setEntityManager($this->erpInvoicePageSearchEntityManagerMock);
        $this->erpInvoicePageSearchBusinessFactory->setQueryContainer($this->erpInvoicePageSearchQueryContainerMock);
        $this->erpInvoicePageSearchBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCeateErpInvoicePageSearchPublisher()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::SERVICE_UTIL_ENCODING)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::SERVICE_UTIL_ENCODING)
            ->willReturn($this->erpInvoicePageSearchToUtilEncodingServiceMock);

        $this->assertInstanceOf(
            ErpInvoicePageSearchPublisherInterface::class,
            $this->erpInvoicePageSearchBusinessFactory->createErpInvoicePageSearchPublisher(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpInvoicePageSearchUnPublisher()
    {
        $this->assertInstanceOf(
            ErpInvoicePageSearchUnpublisherInterface::class,
            $this->erpInvoicePageSearchBusinessFactory->createErpInvoicePageSearchUnPublisher(),
        );
    }
}
