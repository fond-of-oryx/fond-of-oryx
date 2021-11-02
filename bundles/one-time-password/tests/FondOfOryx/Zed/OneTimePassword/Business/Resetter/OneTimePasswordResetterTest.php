<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Resetter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class OneTimePasswordResetterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Resetter\OneTimePasswordResetter
     */
    protected $oneTimePasswordResetter;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEntityManager;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordEntityManager = $this->getMockBuilder(OneTimePasswordEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResetter = new OneTimePasswordResetter(
            $this->oneTimePasswordEntityManager,
        );
    }

    /**
     * @return void
     */
    public function testResetOneTimePassword(): void
    {
        $this->oneTimePasswordEntityManager->expects($this->atLeastOnce())
            ->method('resetCustomerPassword')
            ->with($this->customerTransferMock);

        $this->oneTimePasswordResetter->resetOneTimePassword(
            $this->customerTransferMock,
        );
    }
}
