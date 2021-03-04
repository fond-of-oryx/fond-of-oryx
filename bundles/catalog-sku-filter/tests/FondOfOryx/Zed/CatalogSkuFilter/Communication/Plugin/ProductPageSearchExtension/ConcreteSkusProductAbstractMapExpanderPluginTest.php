<?php

namespace FondOfOryx\Zed\CatalogSkuFilter\Communication\Plugin\ProductPageSearchExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;

class ConcreteSkusProductAbstractMapExpanderPluginTest extends Unit
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
     * @var string[]
     */
    protected $productData;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CatalogSkuFilter\Communication\Plugin\ProductPageSearchExtension\ConcreteSkusProductAbstractMapExpanderPlugin
     */
    protected $concreteSkusProductAbstractMapExpanderPlugin;

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

        $this->productData = [
            ConcreteSkusProductAbstractMapExpanderPlugin::KEY_CONCRETE_SKUS => 'FOO-BAR-1-1, FOO-BAR-1-2',
        ];

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteSkusProductAbstractMapExpanderPlugin = new ConcreteSkusProductAbstractMapExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandProductMap(): void
    {
        $this->pageMapTransferMock->expects(static::atLeastOnce())
            ->method('setConcreteSkus')
            ->with(
                explode(
                    ', ',
                    $this->productData[ConcreteSkusProductAbstractMapExpanderPlugin::KEY_CONCRETE_SKUS]
                )
            )->willReturn($this->pageMapTransferMock);

        $pageMapTransfer = $this->concreteSkusProductAbstractMapExpanderPlugin->expandProductMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            $this->productData,
            $this->localeTransferMock
        );

        static::assertEquals(
            $this->pageMapTransferMock,
            $pageMapTransfer
        );
    }

    /**
     * @return void
     */
    public function testExpandProductMapWithoutSku(): void
    {
        $this->pageMapTransferMock->expects(static::never())
            ->method('setConcreteSkus');

        $pageMapTransfer = $this->concreteSkusProductAbstractMapExpanderPlugin->expandProductMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            [],
            $this->localeTransferMock
        );

        static::assertEquals(
            $this->pageMapTransferMock,
            $pageMapTransfer
        );
    }
}
