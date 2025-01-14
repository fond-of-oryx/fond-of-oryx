<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManager;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainer;
use Spryker\Zed\Kernel\Container;

class ErpDeliveryNotePageSearchBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchBusinessFactory
     */
    protected $erpDeliveryNotePageSearchBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManager
     */
    protected $erpDeliveryNotePageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainer
     */
    protected $erpDeliveryNotePageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
     */
    protected $erpDeliveryNotePageSearchToUtilEncodingServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ErpDeliveryNotePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchEntityManagerMock = $this->getMockBuilder(ErpDeliveryNotePageSearchEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchQueryContainerMock = $this->getMockBuilder(ErpDeliveryNotePageSearchQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToUtilEncodingServiceMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchBusinessFactory = new ErpDeliveryNotePageSearchBusinessFactory();
        $this->erpDeliveryNotePageSearchBusinessFactory->setEntityManager($this->erpDeliveryNotePageSearchEntityManagerMock);
        $this->erpDeliveryNotePageSearchBusinessFactory->setQueryContainer($this->erpDeliveryNotePageSearchQueryContainerMock);
        $this->erpDeliveryNotePageSearchBusinessFactory->setContainer($this->containerMock);
        $this->erpDeliveryNotePageSearchBusinessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNotePageSearchPublisher(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ErpDeliveryNotePageSearchDependencyProvider::SERVICE_UTIL_ENCODING:
                        return $self->erpDeliveryNotePageSearchToUtilEncodingServiceMock;
                    case ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_FULL_TEXT_EXPANDER:
                        return [];
                    case ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ErpDeliveryNotePageSearchPublisher::class,
            $this->erpDeliveryNotePageSearchBusinessFactory->createErpDeliveryNotePageSearchPublisher(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNotePageSearchUnPublisher(): void
    {
        static::assertInstanceOf(
            ErpDeliveryNotePageSearchUnpublisher::class,
            $this->erpDeliveryNotePageSearchBusinessFactory->createErpDeliveryNotePageSearchUnPublisher(),
        );
    }
}
