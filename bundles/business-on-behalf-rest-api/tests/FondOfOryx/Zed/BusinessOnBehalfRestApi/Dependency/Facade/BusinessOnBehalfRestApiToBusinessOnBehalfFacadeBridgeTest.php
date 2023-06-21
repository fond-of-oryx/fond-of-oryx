<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface;

class BusinessOnBehalfRestApiToBusinessOnBehalfFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected BusinessOnBehalfFacadeInterface|MockObject $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\CompanyUserTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserTransfer|MockObject $companyUserTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\CompanyUserResponseTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyUserResponseTransfer $companyUserResponseTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\CustomerTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeBridge
     */
    protected BusinessOnBehalfRestApiToBusinessOnBehalfFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(BusinessOnBehalfFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new BusinessOnBehalfRestApiToBusinessOnBehalfFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testSetDefaultCompanyUser(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUser')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserResponseTransferMock);

        static::assertEquals(
            $this->companyUserResponseTransferMock,
            $this->bridge->setDefaultCompanyUser($this->companyUserTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUnsetDefaultCompanyUserByCustomer(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('unsetDefaultCompanyUserByCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->bridge->unsetDefaultCompanyUserByCustomer($this->customerTransferMock),
        );
    }
}
