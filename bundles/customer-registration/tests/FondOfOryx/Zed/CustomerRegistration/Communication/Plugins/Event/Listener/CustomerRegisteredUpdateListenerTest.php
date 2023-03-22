<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacade;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepository;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\EventEntityTransfer;

class CustomerRegisteredUpdateListenerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\EventEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventEntityTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Event\Listener\CustomerRegisteredUpdateListener
     */
    protected $listener;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->eventEntityTransferMock = $this->getMockBuilder(EventEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerRegistrationRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->listener = new CustomerRegisteredUpdateListener();
        $this->listener->setFacade($this->facadeMock);
        $this->listener->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testHandle(): void
    {
        $this->eventEntityTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn(99);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with(99)
            ->willReturn($this->customerTransferMock);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sendWelcomeMail')
            ->with($this->customerTransferMock);

        $this->listener->handle(
            $this->eventEntityTransferMock,
            CustomerRegistrationConstants::ENTITY_CUSTOMER_UPDATE,
        );
    }
}
