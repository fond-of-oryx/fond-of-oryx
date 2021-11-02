<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearch;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Generated\Shared\Transfer\ProductPayloadTransfer;
use Spryker\Shared\ProductPageSearch\ProductPageSearchConfig;

class BlacklistedLocalesProductPageDataExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ProductPageSearchTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productPageSearchTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductPayloadTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productPayloadTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearch\BlacklistedLocalesProductPageDataExpanderPlugin
     */
    protected $blacklistedLocalesProductPageDataExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productPageSearchTransferMock = $this->getMockBuilder(ProductPageSearchTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productPayloadTransferMock = $this->getMockBuilder(ProductPayloadTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->blacklistedLocalesProductPageDataExpanderPlugin = new BlacklistedLocalesProductPageDataExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandProductPageDataWithInvalidProductData(): void
    {
        $this->productPageSearchTransferMock->expects(static::never())
            ->method('setBlacklistedLocales');

        $this->blacklistedLocalesProductPageDataExpanderPlugin->expandProductPageData(
            [],
            $this->productPageSearchTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testExpandProductPageData(): void
    {
        $blacklistedLocales = ['de_DE', 'en_US', 'fr_FR'];

        $this->productPayloadTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocales')
            ->willReturn($blacklistedLocales);

        $this->productPageSearchTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedLocales')
            ->with($blacklistedLocales)
            ->willReturn($this->productPageSearchTransferMock);

        $this->blacklistedLocalesProductPageDataExpanderPlugin->expandProductPageData(
            [ProductPageSearchConfig::PRODUCT_ABSTRACT_PAGE_LOAD_DATA => $this->productPayloadTransferMock],
            $this->productPageSearchTransferMock,
        );
    }
}
