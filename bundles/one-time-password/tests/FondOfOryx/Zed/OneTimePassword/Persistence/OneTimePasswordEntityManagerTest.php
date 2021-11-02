<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerInterface;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;

class OneTimePasswordEntityManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManager
     */
    protected $oneTimePasswordEntityManager;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordToCustomerQueryContainerMock;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var \Orm\Zed\Customer\Persistence\SpyCustomerQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCustomerQueryMock;

    /**
     * @var string
     */
    protected $newPassword;

    /**
     * @var int
     */
    protected $changedRows;

    /**
     * @var string
     */
    protected $customerReference;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordPersistenceFactoryMock = $this->getMockBuilder(OneTimePasswordPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordToCustomerQueryContainerMock = $this->getMockBuilder(OneTimePasswordToCustomerQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->spyCustomerQueryMock = $this->getMockBuilder(SpyCustomerQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->newPassword = 'new-password';

        $this->changedRows = 1;

        $this->customerReference = 'customer-reference';

        $this->oneTimePasswordEntityManager = new OneTimePasswordEntityManager();
        $this->oneTimePasswordEntityManager->setFactory($this->oneTimePasswordPersistenceFactoryMock);
    }

    /**
     * @return void
     */
    public function testUpdateCustomerPassword(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('requireEmail')
            ->willReturnSelf();

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('requireNewPassword')
            ->willReturnSelf();

        $this->oneTimePasswordPersistenceFactoryMock->expects($this->atLeastOnce())
            ->method('getCustomerQueryContainer')
            ->willReturn($this->oneTimePasswordToCustomerQueryContainerMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($this->email);

        $this->oneTimePasswordToCustomerQueryContainerMock->expects($this->atLeastOnce())
            ->method('queryCustomerByEmail')
            ->with($this->email)
            ->willReturn($this->spyCustomerQueryMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getNewPassword')
            ->willReturn($this->newPassword);

        $this->spyCustomerQueryMock->expects($this->atLeastOnce())
            ->method('update')
            ->with([
                'Password' => $this->newPassword,
            ])
            ->willReturn($this->changedRows);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('setPassword')
            ->with($this->newPassword)
            ->willReturnSelf();

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('setNewPassword')
            ->with(null)
            ->willReturnSelf();

        $this->assertInstanceOf(
            CustomerResponseTransfer::class,
            $this->oneTimePasswordEntityManager->updateCustomerPassword(
                $this->customerTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testResetCustomerPassword(): void
    {
        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('requireCustomerReference')
            ->willReturnSelf();

        $this->oneTimePasswordPersistenceFactoryMock->expects($this->atLeastOnce())
            ->method('getCustomerQueryContainer')
            ->willReturn($this->oneTimePasswordToCustomerQueryContainerMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($this->customerReference);

        $this->oneTimePasswordToCustomerQueryContainerMock->expects($this->atLeastOnce())
            ->method('queryCustomerByReference')
            ->with($this->customerReference)
            ->willReturn($this->spyCustomerQueryMock);

        $this->spyCustomerQueryMock->expects($this->atLeastOnce())
            ->method('update')
            ->with([
                'Password' => null,
            ])
            ->willReturn($this->changedRows);

        $this->oneTimePasswordEntityManager->resetCustomerPassword($this->customerTransferMock);
    }
}
