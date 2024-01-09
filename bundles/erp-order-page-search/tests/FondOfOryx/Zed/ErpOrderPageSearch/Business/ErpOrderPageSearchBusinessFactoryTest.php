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
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class ErpOrderPageSearchBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ErpOrderPageSearchConfig|MockObject $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManager
     */
    protected ErpOrderPageSearchEntityManager|MockObject $erpOrderPageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainer
     */
    protected MockObject|ErpOrderPageSearchQueryContainer $erpOrderPageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected MockObject|ErpOrderPageSearchToUtilEncodingServiceInterface $erpOrderPageSearchToUtilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchBusinessFactory
     */
    protected ErpOrderPageSearchBusinessFactory $erpOrderPageSearchBusinessFactory;

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
    public function testCreateErpOrderPageSearchPublisher(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING],
                [ErpOrderPageSearchDependencyProvider::PLUGINS_FULL_TEXT_EXPANDER],
                [ErpOrderPageSearchDependencyProvider::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING],
                [ErpOrderPageSearchDependencyProvider::PLUGINS_FULL_TEXT_EXPANDER],
                [ErpOrderPageSearchDependencyProvider::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER],
            )->willReturnOnConsecutiveCalls(
                $this->erpOrderPageSearchToUtilEncodingServiceMock,
                [],
                [],
            );

        static::assertInstanceOf(
            ErpOrderPageSearchPublisher::class,
            $this->erpOrderPageSearchBusinessFactory->createErpOrderPageSearchPublisher(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpOrderPageSearchUnPublisher(): void
    {
        static::assertInstanceOf(
            ErpOrderPageSearchUnpublisher::class,
            $this->erpOrderPageSearchBusinessFactory->createErpOrderPageSearchUnPublisher(),
        );
    }
}
