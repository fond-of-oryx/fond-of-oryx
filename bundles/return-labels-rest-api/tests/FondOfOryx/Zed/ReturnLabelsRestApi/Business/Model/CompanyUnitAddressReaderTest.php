<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepository;
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

        $this->companyUnitAddressReader = new CompanyUnitAddressReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetIdCompanyUnitAddressByRestReturnLabelReturnInt(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddressByCompanyUnitAddressUuid')
            ->willReturn(42);

        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressUuid')
            ->willReturn('company-unit-address-uuid');

        $result = $this->companyUnitAddressReader->getIdCompanyUnitAddressByRestReturnLabel(
            $this->restReturnLabelRequestTransferMock
        );

        $this->assertEquals(42, $result);
    }

    /**
     * @return void
     */
    public function testGetIdCompanyUnitAddressByRestReturnLabelReturnNull(): void
    {
        $result = $this->companyUnitAddressReader->getIdCompanyUnitAddressByRestReturnLabel(
            $this->restReturnLabelRequestTransferMock
        );

        $this->assertEquals(null, $result);
    }
}
