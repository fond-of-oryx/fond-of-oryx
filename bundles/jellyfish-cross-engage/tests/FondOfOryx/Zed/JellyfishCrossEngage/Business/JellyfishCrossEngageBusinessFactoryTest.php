<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage\JellyfishCrossEngageReaderInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig;
use FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishCrossEngageBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngageBusinessFactory
     */
    protected $jellyfishCrossEngageBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig
     */
    protected $jellyfishCrossEngageConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface
     */
    protected $productFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface
     */
    protected $productCategoryFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface
     */
    protected $localeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishCrossEngageConfigMock = $this->getMockBuilder(JellyfishCrossEngageConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productFacadeMock = $this->getMockBuilder(JellyfishCrossEngageToProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCategoryFacadeMock = $this->getMockBuilder(JellyfishCrossEngageToProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(JellyfishCrossEngageToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishCrossEngageBusinessFactory = new JellyfishCrossEngageBusinessFactory();
        $this->jellyfishCrossEngageBusinessFactory->setConfig($this->jellyfishCrossEngageConfigMock);
        $this->jellyfishCrossEngageBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateJellyfishCrossEngageReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [JellyfishCrossEngageDependencyProvider::PRODUCT_FACADE],
                [JellyfishCrossEngageDependencyProvider::PRODUCT_CATEGORY_FACADE],
                [JellyfishCrossEngageDependencyProvider::LOCALE_FACADE],
            )->willReturnOnConsecutiveCalls(
                $this->productFacadeMock,
                $this->productCategoryFacadeMock,
                $this->localeTransferMock,
            );

        $this->assertInstanceOf(
            JellyfishCrossEngageReaderInterface::class,
            $this->jellyfishCrossEngageBusinessFactory->createJellyfishCrossEngageReader(),
        );
    }
}
