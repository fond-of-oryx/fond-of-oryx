<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed\CompanyBusinessUnitAddressSearchRestApiStubInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;

class CompanyBusinessUnitAddressSearchRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed\CompanyBusinessUnitAddressSearchRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CompanyBusinessUnitAddressSearchRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSearchCompanies(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCompanyBusinessUnitAddressSearchRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('searchCompanyBusinessUnitAddress')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($this->companyBusinessUnitAddressListTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitAddressListTransferMock,
            $this->client->searchCompanyBusinessUnitAddress($this->companyBusinessUnitAddressListTransferMock),
        );
    }
}
