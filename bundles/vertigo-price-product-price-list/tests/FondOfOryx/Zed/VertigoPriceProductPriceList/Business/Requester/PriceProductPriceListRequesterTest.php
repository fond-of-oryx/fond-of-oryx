<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester;

use Codeception\Test\Unit;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\VertigoPriceApiRequestTransfer;
use Generated\Shared\Transfer\VertigoPriceApiResponseTransfer;
use Throwable;

class PriceProductPriceListRequesterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $vertigoPriceApiAdapterMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\VertigoPriceApiResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $vertigoPriceApiResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productConcreteTransferMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequester
     */
    protected $priceProductPriceListRequester;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->vertigoPriceApiAdapterMock = $this->getMockBuilder(VertigoPriceApiAdapterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(VertigoPriceProductPriceListRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productFacadeMock = $this->getMockBuilder(VertigoPriceProductPriceListToProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->vertigoPriceApiResponseTransferMock = $this->getMockBuilder(VertigoPriceApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListRequester = new PriceProductPriceListRequester(
            $this->vertigoPriceApiAdapterMock,
            $this->repositoryMock,
            $this->productFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testRequestAllMissing(): void
    {
        $skus = ['foo-bar-1', 'foo-bar-2'];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getSkusWithoutPriceProductPriceList')
            ->willReturn($skus);

        $this->vertigoPriceApiAdapterMock->expects(static::atLeastOnce())
            ->method('sendRequest')
            ->with(
                static::callback(
                    static function (VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer) use ($skus) {
                        return $vertigoPriceApiRequestTransfer->getBody()['skus'] === $skus;
                    },
                ),
            )->willReturn($this->vertigoPriceApiResponseTransferMock);

        $this->priceProductPriceListRequester->requestAllMissing();
    }

    /**
     * @return void
     */
    public function testRequestAllMissingWithoutSkus(): void
    {
        $skus = [];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getSkusWithoutPriceProductPriceList')
            ->willReturn($skus);

        $this->vertigoPriceApiAdapterMock->expects(static::never())
            ->method('sendRequest');

        $this->priceProductPriceListRequester->requestAllMissing();
    }

    /**
     * @return void
     */
    public function testRequestBySku(): void
    {
        $sku = 'foo-bar-1';

        $this->productFacadeMock->expects(static::atLeastOnce())
            ->method('hasProductConcrete')
            ->with($sku)
            ->willReturn(true);

        $this->vertigoPriceApiAdapterMock->expects(static::atLeastOnce())
            ->method('sendRequest')
            ->with(
                static::callback(
                    static function (VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer) use ($sku) {
                        return in_array($sku, $vertigoPriceApiRequestTransfer->getBody()['skus'], true);
                    },
                ),
            )->willReturn($this->vertigoPriceApiResponseTransferMock);

        $this->priceProductPriceListRequester->requestBySku($sku);
    }

    /**
     * @return void
     */
    public function testRequestBySkuWithNonExistingSku(): void
    {
        $sku = 'foo-bar-1';

        $this->productFacadeMock->expects(static::atLeastOnce())
            ->method('hasProductConcrete')
            ->with($sku)
            ->willReturn(false);

        $this->vertigoPriceApiAdapterMock->expects(static::never())
            ->method('sendRequest');

        try {
            $this->priceProductPriceListRequester->requestBySku($sku);
            static::fail();
        } catch (Throwable $exception) {
        }
    }

    /**
     * @return void
     */
    public function testRequestMissingByProductConcrete(): void
    {
        $sku = 'foo-bar-1';

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPriceProductPriceList')
            ->with($sku)
            ->willReturn(false);

        $this->productFacadeMock->expects(static::atLeastOnce())
            ->method('hasProductConcrete')
            ->with($sku)
            ->willReturn(true);

        $this->vertigoPriceApiAdapterMock->expects(static::atLeastOnce())
            ->method('sendRequest')
            ->with(
                static::callback(
                    static function (VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer) use ($sku) {
                        return in_array($sku, $vertigoPriceApiRequestTransfer->getBody()['skus'], true);
                    },
                ),
            )->willReturn($this->vertigoPriceApiResponseTransferMock);

        $this->priceProductPriceListRequester->requestMissingByProductConcrete($this->productConcreteTransferMock);
    }

    /**
     * @return void
     */
    public function testRequestMissingByProductConcreteWithoutSku(): void
    {
        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
            ->method('hasPriceProductPriceList');

        $this->productFacadeMock->expects(static::never())
            ->method('hasProductConcrete');

        $this->vertigoPriceApiAdapterMock->expects(static::never())
            ->method('sendRequest');

        $this->priceProductPriceListRequester->requestMissingByProductConcrete($this->productConcreteTransferMock);
    }
}
