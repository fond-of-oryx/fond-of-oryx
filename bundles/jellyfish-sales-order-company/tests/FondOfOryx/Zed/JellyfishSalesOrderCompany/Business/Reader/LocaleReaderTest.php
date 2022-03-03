<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

class LocaleReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReader
     */
    protected $localeReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeFacadeMock = $this->getMockBuilder(JellyfishSalesOrderCompanyToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeReader = new LocaleReader($this->localeFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetNameByCompany(): void
    {
        $idLocale = 1;
        $localeName = 'de_DE';

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($idLocale);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getLocaleById')
            ->with($idLocale)
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($localeName);

        static::assertEquals(
            $localeName,
            $this->localeReader->getNameByCompany($this->companyTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetNameByCompanyWithNullableLocaleId(): void
    {
        $idLocale = null;

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($idLocale);

        $this->localeFacadeMock->expects(static::never())
            ->method('getLocaleById');

        static::assertEquals(
            null,
            $this->localeReader->getNameByCompany($this->companyTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetNameByCompanyWithNonExistingLocale(): void
    {
        $idLocale = 1;

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($idLocale);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getLocaleById')
            ->willThrowException(new Exception());

        static::assertEquals(
            null,
            $this->localeReader->getNameByCompany($this->companyTransferMock),
        );
    }
}
