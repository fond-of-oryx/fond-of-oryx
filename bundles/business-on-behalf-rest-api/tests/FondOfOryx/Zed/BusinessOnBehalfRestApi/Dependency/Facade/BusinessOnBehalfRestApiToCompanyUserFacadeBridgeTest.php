<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface;

class BusinessOnBehalfRestApiToCompanyUserFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserFacadeInterface|MockObject $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserTransfer|MockObject $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeBridge
     */
    protected BusinessOnBehalfRestApiToCompanyUserFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new BusinessOnBehalfRestApiToCompanyUserFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUserById(): void
    {
        $idCompanyUser = 1;

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUserById')
            ->with($idCompanyUser)
            ->willReturn($this->companyUserTransferMock);

        static::assertEquals(
            $this->companyUserTransferMock,
            $this->bridge->getCompanyUserById($idCompanyUser),
        );
    }
}
