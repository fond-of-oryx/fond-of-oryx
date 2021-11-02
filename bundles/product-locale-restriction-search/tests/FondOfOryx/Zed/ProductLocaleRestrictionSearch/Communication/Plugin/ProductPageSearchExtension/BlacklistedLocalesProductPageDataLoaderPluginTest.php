<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearchExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\ProductLocaleRestrictionSearchCommunicationFactory;
use FondOfOryx\Zed\ProductLocaleRestrictionSearch\Dependency\Facade\ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface;
use Generated\Shared\Transfer\ProductPageLoadTransfer;
use Generated\Shared\Transfer\ProductPayloadTransfer;

class BlacklistedLocalesProductPageDataLoaderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\ProductLocaleRestrictionSearchCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Dependency\Facade\ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductPageLoadTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productPageLoadTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\ProductPayloadTransfer>
     */
    protected $productPayloadTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearchExtension\BlacklistedLocalesProductPageDataLoaderPlugin
     */
    protected $blacklistedLocalesProductPageDataLoaderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductLocaleRestrictionSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productPageLoadTransferMock = $this->getMockBuilder(ProductPageLoadTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productPayloadTransferMocks = [
            $this->getMockBuilder(ProductPayloadTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ProductPayloadTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->blacklistedLocalesProductPageDataLoaderPlugin = new BlacklistedLocalesProductPageDataLoaderPlugin();
        $this->blacklistedLocalesProductPageDataLoaderPlugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandProductPageDataTransfer(): void
    {
        $productAbstractIds = [1, 2];
        $blacklistedLocales = [1 => ['de_DE', 'en_US']];

        $this->productPageLoadTransferMock->expects(static::atLeastOnce())
            ->method('getProductAbstractIds')
            ->willReturn($productAbstractIds);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getProductLocaleRestrictionFacade')
            ->willReturn($this->productLocaleRestrictionFacadeMock);

        $this->productLocaleRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocalesByProductAbstractIds')
            ->with($productAbstractIds)
            ->willReturn($blacklistedLocales);

        $this->productPageLoadTransferMock->expects(static::atLeastOnce())
            ->method('getPayloadTransfers')
            ->willReturn($this->productPayloadTransferMocks);

        $this->productPayloadTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($productAbstractIds[0]);

        $this->productPayloadTransferMocks[0]->expects(static::atLeastOnce())
            ->method('setBlacklistedLocales')
            ->with($blacklistedLocales[1])
            ->willReturn($this->productPayloadTransferMocks[0]);

        $this->productPayloadTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($productAbstractIds[1]);

        $this->productPayloadTransferMocks[1]->expects(static::never())
            ->method('setBlacklistedLocales');

        static::assertEquals(
            $this->productPageLoadTransferMock,
            $this->blacklistedLocalesProductPageDataLoaderPlugin->expandProductPageDataTransfer(
                $this->productPageLoadTransferMock,
            ),
        );
    }
}
