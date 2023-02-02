<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\UnPublisher\ErpOrderPageSearchUnpublisher;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManager;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainer;
use Spryker\Zed\Kernel\Container;

class ErpOrderPageSearchBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchBusinessFactory
     */
    protected $erpOrderPageSearchBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManager
     */
    protected $erpOrderPageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainer
     */
    protected $erpOrderPageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected $erpOrderPageSearchToUtilEncodingServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ErpOrderPageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchEntityManagerMock = $this->getMockBuilder(ErpOrderPageSearchEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchQueryContainerMock = $this->getMockBuilder(ErpOrderPageSearchQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToUtilEncodingServiceMock = $this->getMockBuilder(ErpOrderPageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchBusinessFactory = new ErpOrderPageSearchBusinessFactory();
        $this->erpOrderPageSearchBusinessFactory->setEntityManager($this->erpOrderPageSearchEntityManagerMock);
        $this->erpOrderPageSearchBusinessFactory->setQueryContainer($this->erpOrderPageSearchQueryContainerMock);
        $this->erpOrderPageSearchBusinessFactory->setContainer($this->containerMock);
        $this->erpOrderPageSearchBusinessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCeateErpOrderPageSearchPublisher()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING)
            ->willReturn($this->erpOrderPageSearchToUtilEncodingServiceMock);

        static::assertInstanceOf(
            ErpOrderPageSearchPublisher::class,
            $this->erpOrderPageSearchBusinessFactory->createErpOrderPageSearchPublisher(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpOrderPageSearchUnPublisher()
    {
        static::assertInstanceOf(
            ErpOrderPageSearchUnpublisher::class,
            $this->erpOrderPageSearchBusinessFactory->createErpOrderPageSearchUnPublisher(),
        );
    }
}
