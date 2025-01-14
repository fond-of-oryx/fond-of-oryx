<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisher;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher\ErpInvoicePageSearchUnpublisher;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;
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
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

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

        $this->configMock = $this->getMockBuilder(ErpInvoicePageSearchConfig::class)
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
        $this->erpInvoicePageSearchBusinessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCeateErpInvoicePageSearchPublisher(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ErpInvoicePageSearchDependencyProvider::SERVICE_UTIL_ENCODING:
                        return $self->erpInvoicePageSearchToUtilEncodingServiceMock;
                    case ErpInvoicePageSearchDependencyProvider::PLUGINS_FULL_TEXT_EXPANDER:
                        return [];
                    case ErpInvoicePageSearchDependencyProvider::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ErpInvoicePageSearchPublisher::class,
            $this->erpInvoicePageSearchBusinessFactory->createErpInvoicePageSearchPublisher(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpInvoicePageSearchUnPublisher(): void
    {
        static::assertInstanceOf(
            ErpInvoicePageSearchUnpublisher::class,
            $this->erpInvoicePageSearchBusinessFactory->createErpInvoicePageSearchUnPublisher(),
        );
    }
}
