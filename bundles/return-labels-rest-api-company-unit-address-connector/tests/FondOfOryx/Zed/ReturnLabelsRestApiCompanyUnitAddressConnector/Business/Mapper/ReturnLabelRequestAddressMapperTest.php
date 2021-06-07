<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class ReturnLabelRequestAddressMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ReturnLabelRequestAddressMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyUnitAddressTransfer(): void
    {
        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->mapper->fromCompanyUnitAddressTransfer($this->companyUnitAddressTransferMock);
    }
}
