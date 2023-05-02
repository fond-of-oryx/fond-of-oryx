<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Shared\RepresentativeCompanyUser\RepresentativeCompanyUserConstants;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacade;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserCompanyUserCreatorListenerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserFilterTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Listener\RepresentativeCompanyUserCompanyUserCreatorListener
     */
    protected $listener;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(RepresentativeCompanyUserFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserFilterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->listener = new RepresentativeCompanyUserCompanyUserCreatorListener();
        $this->listener->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testHandle(): void
    {
        $this->facadeMock
            ->expects(static::once())
            ->method('createCompanyUserForRepresentation');

        $this->facadeMock
            ->expects(static::once())
            ->method('setRepresentationState');

        $this->representativeCompanyUserTransferMock
            ->expects(static::once())
            ->method('getUuid')
            ->willReturn('uuid');

        $this->listener->handle($this->representativeCompanyUserTransferMock, RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_CREATE_COMPANY_USER);
    }

    /**
     * @return void
     */
    public function testHandleWrongTransfer(): void
    {
        $this->facadeMock
            ->expects(static::never())
            ->method('createCompanyUserForRepresentation');

        $this->listener->handle($this->representativeCompanyUserFilterTransferMock, RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_CREATE_COMPANY_USER);
    }
}
