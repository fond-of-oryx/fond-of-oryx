<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepository;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CompanyUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ReturnLabelsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressReader = new CompanyUnitAddressReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressByRestReturnLabelReturnTransfer(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressUuid')
            ->willReturn('company-unit-address-uuid');

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressByCompanyUnitAddressUuid')
            ->willReturn($this->companyUnitAddressTransferMock);

        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getCompanyUnitAddressByRestReturnLabel(
            $this->restReturnLabelRequestTransferMock
        );

        $this->assertInstanceOf(
            CompanyUnitAddressTransfer::class,
            $companyUnitAddressTransfer
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressByRestReturnLabelReturnNull(): void
    {
        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getCompanyUnitAddressByRestReturnLabel(
            $this->restReturnLabelRequestTransferMock
        );

        $this->assertEquals(null, $companyUnitAddressTransfer);
    }
}
