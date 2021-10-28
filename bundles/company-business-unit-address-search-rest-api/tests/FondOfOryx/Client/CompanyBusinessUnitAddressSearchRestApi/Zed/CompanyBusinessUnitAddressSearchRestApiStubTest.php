<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;

class CompanyBusinessUnitAddressSearchRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed\CompanyBusinessUnitAddressSearchRestApiStub
     */
    protected $companySearchRestApiStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companySearchRestApiStub = new CompanyBusinessUnitAddressSearchRestApiStub(
            $this->zedRequestClientMock
        );
    }

    /**
     * @return void
     */
    public function testSearchCompanyBusinessUnitAddress(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/company-business-unit-address-search-rest-api/gateway/search-company-business-unit-address',
                $this->companyBusinessUnitAddressListTransferMock
            )->willReturn($this->companyBusinessUnitAddressListTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitAddressListTransferMock,
            $this->companySearchRestApiStub->searchCompanyBusinessUnitAddress($this->companyBusinessUnitAddressListTransferMock)
        );
    }
}
