<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\CurrencyReaderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReaderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeReaderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\CurrencyReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $currencyReaderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserReferenceFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander\JellyfishOrderExpander
     */
    protected $jellyfishOrderExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeReaderMock = $this->getMockBuilder(LocaleReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currencyReaderMock = $this->getMockBuilder(CurrencyReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceFacadeMock = $this->getMockBuilder(JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderExpander = new JellyfishOrderExpander(
            $this->localeReaderMock,
            $this->currencyReaderMock,
            $this->companyUserReferenceFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idCompany = 1;
        $companyUuid = 'b7c08ca5-24b7-4d37-98c9-95c8c862948e';
        $companyUserReference = 'FOO--CU-1';
        $locale = 'de_DE';
        $currency = 'EUR';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->companyUserReferenceFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyByCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($companyUuid);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUuid')
            ->with($companyUuid)
            ->willReturn($this->jellyfishOrderTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyId')
            ->with($idCompany)
            ->willReturn($this->jellyfishOrderTransferMock);

        $this->localeReaderMock->expects(static::atLeastOnce())
            ->method('getNameByCompany')
            ->with($this->companyTransferMock)
            ->willReturn($locale);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyLocale')
            ->with($locale)
            ->willReturn($this->jellyfishOrderTransferMock);

        $this->currencyReaderMock->expects(static::atLeastOnce())
            ->method('getCodeByCompany')
            ->with($this->companyTransferMock)
            ->willReturn($currency);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyCurrency')
            ->with($currency)
            ->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->jellyfishOrderExpander->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNullableCompanyUserReference(): void
    {
        $companyUserReference = null;

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->companyUserReferenceFacadeMock->expects(static::never())
            ->method('getCompanyByCompanyUserReference');

        $this->localeReaderMock->expects(static::never())
            ->method('getNameByCompany');

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->jellyfishOrderExpander->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNonExistingCompany(): void
    {
        $companyUserReference = 'FOO--CU-1';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->companyUserReferenceFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyByCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn(null);

        $this->localeReaderMock->expects(static::never())
            ->method('getNameByCompany');

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->jellyfishOrderExpander->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }
}
