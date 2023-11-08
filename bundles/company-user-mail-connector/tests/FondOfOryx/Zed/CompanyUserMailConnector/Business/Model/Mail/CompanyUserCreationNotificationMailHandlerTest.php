<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Mail;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandler;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandlerInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\NotificationCustomerCollectionTransfer;
use Generated\Shared\Transfer\NotificationCustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserCreationNotificationMailHandlerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserTransfer|MockObject $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorToMailFacadeInterface|MockObject $mailFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandlerInterface
     */
    protected CompanyUserCreationNotificationMailHandlerInterface $mailHandler;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LocaleTransfer|MockObject $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyRoleCollectionTransfer|MockObject $companyRoleCollectionMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyRoleTransfer|MockObject $companyRoleTransferMock;

    /**
     * @var \Generated\Shared\Transfer\NotificationCustomerCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected NotificationCustomerCollectionTransfer|MockObject $notificationCustomerCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\NotificationCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected NotificationCustomerTransfer|MockObject $notificationCustomerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LocaleReaderInterface|MockObject $localeReaderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeReaderMock = $this->getMockBuilder(LocaleReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this
            ->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this
            ->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailFacadeMock = $this
            ->getMockBuilder(CompanyUserMailConnectorToMailFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this
            ->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->notificationCustomerCollectionTransferMock = $this
            ->getMockBuilder(NotificationCustomerCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->notificationCustomerTransferMock = $this
            ->getMockBuilder(NotificationCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCollectionMock = $this
            ->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this
            ->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this
            ->getMockBuilder(CompanyUserMailConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(CompanyUserMailConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailHandler = new CompanyUserCreationNotificationMailHandler(
            $this->localeReaderMock,
            $this->mailFacadeMock,
            $this->repositoryMock,
            $this->configMock,
        );
    }

    /**
     * @return void
     */
    public function testSendInformationMail(): void
    {
        $roleName = 'test';
        $roleToNotifyName = 'admin';
        $roles = new ArrayObject();
        $roles->append($this->companyRoleTransferMock);
        $notifyCollection = new ArrayObject();
        $notifyCollection->append($this->notificationCustomerTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionMock);

        $this->companyRoleCollectionMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn($roles);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($roleName);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getRolesToInformAbout')
            ->willReturn([$roleName]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getRolesToNotify')
            ->willReturn([$roleToNotifyName]);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIsNew')
            ->willReturn(true);

        $this->localeReaderMock->expects(static::atLeastOnce())
            ->method('getByNotificationCustomer')
            ->with($this->notificationCustomerTransferMock)
            ->willReturn($this->localeTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getNotificationCustomerByFkCompanyAndRole')
            ->willReturn($this->notificationCustomerCollectionTransferMock);

        $this->notificationCustomerCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getNotificationCustomers')
            ->willReturn($notifyCollection);

        $this->mailFacadeMock->expects(static::atLeastOnce())
            ->method('handleMail');

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->mailHandler->sendCustomerNotificationMails(
                $this->companyUserTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testSendInformationMailWithRolesNotMatch(): void
    {
        $roleName = 'test';
        $roles = new ArrayObject();
        $roles->append($this->companyRoleTransferMock);
        $notifyCollection = new ArrayObject();
        $notifyCollection->append($this->notificationCustomerTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionMock);

        $this->companyRoleCollectionMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn($roles);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn('testing');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getRolesToInformAbout')
            ->willReturn([$roleName]);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIsNew')
            ->willReturn(true);

        $this->repositoryMock->expects(static::never())
            ->method('getNotificationCustomerByFkCompanyAndRole');

        $this->mailFacadeMock->expects(static::never())
            ->method('handleMail');

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->mailHandler->sendCustomerNotificationMails(
                $this->companyUserTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testSendInformationMailWithNoMatchingInformerRole(): void
    {
        $roleName = 'test';
        $roleToNotifyName = 'admin';
        $roles = new ArrayObject();
        $roles->append($this->companyRoleTransferMock);
        $notifyCollection = new ArrayObject();

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionMock);

        $this->companyRoleCollectionMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn($roles);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($roleName);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getRolesToInformAbout')
            ->willReturn([$roleName]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getRolesToNotify')
            ->willReturn([$roleToNotifyName]);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIsNew')
            ->willReturn(true);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getNotificationCustomerByFkCompanyAndRole')
            ->willReturn($this->notificationCustomerCollectionTransferMock);

        $this->notificationCustomerCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getNotificationCustomers')
            ->willReturn($notifyCollection);

        $this->mailFacadeMock->expects(static::never())
            ->method('handleMail');

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->mailHandler->sendCustomerNotificationMails(
                $this->companyUserTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testSendMailWithNoNewCustomer(): void
    {
        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIsNew')
            ->willReturn(false);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->mailHandler->sendCustomerNotificationMails(
                $this->companyUserTransferMock,
            ),
        );
    }
}
