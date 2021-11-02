<?php

namespace FondOfOryx\Zed\CatalogSkuFilter\Communication\Plugin\ProductPageSearchExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;

class SkuProductAbstractMapExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PageMapTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pageMapTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface
     */
    protected $pageMapBuilderMock;

    /**
     * @var array<string>
     */
    protected $productData;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CatalogSkuFilter\Communication\Plugin\ProductPageSearchExtension\SkuProductAbstractMapExpanderPlugin
     */
    protected $skuProductAbstractMapExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->pageMapTransferMock = $this->getMockBuilder(PageMapTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMapBuilderMock = $this->getMockBuilder(PageMapBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productData = [SkuProductAbstractMapExpanderPlugin::KEY_SKU => 'Abstract-FOO-BAR-1'];

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->skuProductAbstractMapExpanderPlugin = new SkuProductAbstractMapExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandProductMap(): void
    {
        $this->pageMapTransferMock->expects(static::atLeastOnce())
            ->method('setSku')
            ->with($this->productData[SkuProductAbstractMapExpanderPlugin::KEY_SKU])
            ->willReturn($this->pageMapTransferMock);

        $pageMapTransfer = $this->skuProductAbstractMapExpanderPlugin->expandProductMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            $this->productData,
            $this->localeTransferMock,
        );

        static::assertEquals(
            $this->pageMapTransferMock,
            $pageMapTransfer,
        );
    }

    /**
     * @return void
     */
    public function testExpandProductMapWithoutSku(): void
    {
        $this->pageMapTransferMock->expects(static::never())
            ->method('setSku');

        $pageMapTransfer = $this->skuProductAbstractMapExpanderPlugin->expandProductMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            [],
            $this->localeTransferMock,
        );

        static::assertEquals(
            $this->pageMapTransferMock,
            $pageMapTransfer,
        );
    }
}
