<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCurrencyFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CurrencyTransfer;

class CurrencyReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCurrencyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $currencyFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CurrencyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $currencyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\CurrencyReader
     */
    protected $currencyReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->currencyFacadeMock = $this->getMockBuilder(JellyfishSalesOrderCompanyToCurrencyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currencyTransferMock = $this->getMockBuilder(CurrencyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currencyReader = new CurrencyReader($this->currencyFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetNameByCompany(): void
    {
        $idCurrency = 1;
        $currencyCode = 'EUR';

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getFkCurrency')
            ->willReturn($idCurrency);

        $this->currencyFacadeMock->expects(static::atLeastOnce())
            ->method('getByIdCurrency')
            ->with($idCurrency)
            ->willReturn($this->currencyTransferMock);

        $this->currencyTransferMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($currencyCode);

        static::assertEquals(
            $currencyCode,
            $this->currencyReader->getCodeByCompany($this->companyTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetNameByCompanyWithNullableCurrencyId(): void
    {
        $idCurrency = null;

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getFkCurrency')
            ->willReturn($idCurrency);

        $this->currencyFacadeMock->expects(static::never())
            ->method('getByIdCurrency');

        static::assertEquals(
            null,
            $this->currencyReader->getCodeByCompany($this->companyTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetNameByCompanyWithNonExistingCurrency(): void
    {
        $idCurrency = 1;

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getFkCurrency')
            ->willReturn($idCurrency);

        $this->currencyFacadeMock->expects(static::atLeastOnce())
            ->method('getByIdCurrency')
            ->willThrowException(new Exception());

        static::assertEquals(
            null,
            $this->currencyReader->getCodeByCompany($this->companyTransferMock),
        );
    }
}
