<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CurrencyTransfer;
use Spryker\Zed\Currency\Business\CurrencyFacadeInterface;

class JellyfishSalesOrderCompanyToCurrencyFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Currency\Business\CurrencyFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CurrencyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $currencyTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCurrencyFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CurrencyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currencyTransferMock = $this->getMockBuilder(CurrencyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishSalesOrderCompanyToCurrencyFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCurrencyById(): void
    {
        $idCurrency = 1;

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getByIdCurrency')
            ->with($idCurrency)
            ->willReturn($this->currencyTransferMock);

        static::assertEquals($this->currencyTransferMock, $this->bridge->getByIdCurrency($idCurrency));
    }
}
