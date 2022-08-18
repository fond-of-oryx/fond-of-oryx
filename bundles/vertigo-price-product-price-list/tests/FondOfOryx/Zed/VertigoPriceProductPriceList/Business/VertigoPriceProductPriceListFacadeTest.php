<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequesterInterface;
use Generated\Shared\Transfer\ProductConcreteTransfer;

class VertigoPriceProductPriceListFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequesterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $priceProductPriceListRequesterMock;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productConcreteTransferMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(VertigoPriceProductPriceListBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListRequesterMock = $this->getMockBuilder(PriceProductPriceListRequesterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new VertigoPriceProductPriceListFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testRequestMissingPriceProductPriceList(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createPriceProductPriceListRequester')
            ->willReturn($this->priceProductPriceListRequesterMock);

        $this->priceProductPriceListRequesterMock->expects(static::atLeastOnce())
            ->method('requestAllMissing');

        $this->facade->requestMissingPriceProductPriceList();
    }

    /**
     * @return void
     */
    public function testRequestPriceProductPriceListBySku(): void
    {
        $sku = 'foo-bar-1';

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createPriceProductPriceListRequester')
            ->willReturn($this->priceProductPriceListRequesterMock);

        $this->priceProductPriceListRequesterMock->expects(static::atLeastOnce())
            ->method('requestBySku')
            ->with($sku);

        $this->facade->requestPriceProductPriceListBySku($sku);
    }

    /**
     * @return void
     */
    public function testRequestPriceProductPriceListBySkuX(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createPriceProductPriceListRequester')
            ->willReturn($this->priceProductPriceListRequesterMock);

        $this->priceProductPriceListRequesterMock->expects(static::atLeastOnce())
            ->method('requestMissingByProductConcrete')
            ->with($this->productConcreteTransferMock);

        $this->facade->requestMissingPriceProductPriceListByProductConcrete($this->productConcreteTransferMock);
    }
}
