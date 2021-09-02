<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductAvailabilityCriteriaTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\DecimalObject\Decimal;
use Spryker\Zed\Availability\Business\AvailabilityFacadeInterface;

class AvailabilityCartDataExtenderToAvailabilityFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeBridge
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->facadeMock = $this->getMockBuilder(AvailabilityFacadeInterface::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new AvailabilityCartDataExtenderToAvailabilityFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testIsProductSellableForStore(): void
    {
        $this->facadeMock->expects(static::once())->method('isProductSellableForStore');

        $this->toTest->isProductSellableForStore('sku', new Decimal(1), new StoreTransfer());
    }

    /**
     * @return void
     */
    public function testFindOrCreateProductConcreteAvailabilityBySkuForStore(): void
    {
        if (method_exists($this->facadeMock, 'findOrCreateProductConcreteAvailabilityBySkuForStore')) {
            $this->facadeMock->expects(static::once())->method('findOrCreateProductConcreteAvailabilityBySkuForStore');
        } else {
            $this->facadeMock->expects(static::once())->method('findProductConcreteAvailability');
        }

        $this->toTest->findOrCreateProductConcreteAvailabilityBySkuForStore('sku', new StoreTransfer(), new ProductAvailabilityCriteriaTransfer());
    }
}
