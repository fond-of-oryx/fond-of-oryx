<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
     */
    protected $facadeBridge;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->representativeCompanyUserFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeBridge(
            $this->representativeCompanyUserFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testAddRepresentativeCompanyUser(): void
    {
        $this->representativeCompanyUserFacadeMock
            ->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->facadeBridge->addRepresentativeCompanyUser($this->representativeCompanyUserTransferMock);
    }
}
