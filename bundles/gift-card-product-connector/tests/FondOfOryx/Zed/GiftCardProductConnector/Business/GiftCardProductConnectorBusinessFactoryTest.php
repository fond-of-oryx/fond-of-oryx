<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface;
use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig;
use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorDependencyProvider;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class GiftCardProductConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(GiftCardProductConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(GiftCardProductConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productFacadeMock = $this->getMockBuilder(GiftCardProductConnectorToProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new GiftCardProductConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
        $this->businessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProductAbstractConfigurationWriter(): void
    {
        static::assertInstanceOf(
            GiftCardProductAbstractConfigurationWriterInterface::class,
            $this->businessFactory->createGiftCardProductAbstractConfigurationWriter()
        );
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProductConfigurationWriter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardProductConnectorDependencyProvider::FACADE_PRODUCT)
            ->willReturn($this->productFacadeMock);

        static::assertInstanceOf(
            GiftCardProductConfigurationWriterInterface::class,
            $this->businessFactory->createGiftCardProductConfigurationWriter()
        );
    }
}
