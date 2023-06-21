<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyType\Business\CompanyTypeFacadeInterface;
use Generated\Shared\Transfer\CompanyTypeTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTypeTransfer
     */
    protected MockObject|CompanyTypeTransfer $companyTypeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyType\Business\CompanyTypeFacadeInterface
     */
    protected MockObject|CompanyTypeFacadeInterface $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
     */
    protected RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this
            ->getMockBuilder(CompanyTypeFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeTransferMock = $this
            ->getMockBuilder(CompanyTypeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyTypeManufacturer(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $companyTypeTransfer = $this->facadeBridge->getCompanyTypeManufacturer();

        static::assertEquals(
            $this->companyTypeTransferMock,
            $companyTypeTransfer,
        );
    }
}
