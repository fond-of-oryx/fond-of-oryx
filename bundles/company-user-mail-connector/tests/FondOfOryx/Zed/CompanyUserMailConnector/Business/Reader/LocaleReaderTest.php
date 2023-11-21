<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\NotificationCustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class LocaleReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface
     */
    protected MockObject|CompanyUserMailConnectorToLocaleFacadeInterface $localeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\NotificationCustomerTransfer
     */
    protected MockObject|NotificationCustomerTransfer $notificationCustomerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected MockObject|LocaleTransfer $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReader
     */
    protected LocaleReader $localeReader;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeFacadeMock = $this->getMockBuilder(CompanyUserMailConnectorToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->notificationCustomerTransferMock = $this->getMockBuilder(NotificationCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeReader = new LocaleReader(
            $this->localeFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByCustomer(): void
    {
        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->customerTransferMock->expects(static::never())
            ->method('getFkLocale');

        $this->localeFacadeMock->expects(static::never())
            ->method('getCurrentLocale');

        $this->localeFacadeMock->expects(static::never())
            ->method('getLocaleById');

        static::assertEquals($this->localeTransferMock, $this->localeReader->getByCustomer($this->customerTransferMock));
    }

    /**
     * @return void
     */
    public function testGetByCustomerWithoutLocale(): void
    {
        $idLocale = 1;

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($idLocale);

        $this->localeFacadeMock->expects(static::never())
            ->method('getCurrentLocale');

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getLocaleById')
            ->with($idLocale)
            ->willReturn($this->localeTransferMock);

        static::assertEquals($this->localeTransferMock, $this->localeReader->getByCustomer($this->customerTransferMock));
    }

    /**
     * @return void
     */
    public function testGetByCustomerWithoutLocaleAndFkLocale(): void
    {
        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn(null);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeFacadeMock->expects(static::never())
            ->method('getLocaleById');

        static::assertEquals($this->localeTransferMock, $this->localeReader->getByCustomer($this->customerTransferMock));
    }

    /**
     * @return void
     */
    public function testGetByCustomerWithFkLocaleAndException(): void
    {
        $idLocale = 2;

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($idLocale);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getLocaleById')
            ->with($idLocale)
            ->willThrowException(new Exception());

        static::assertEquals($this->localeTransferMock, $this->localeReader->getByCustomer($this->customerTransferMock));
    }

    /**
     * @return void
     */
    public function testGetByNotificationCustomer(): void
    {
        $idLocale = 3;

        $this->notificationCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn($idLocale);

        $this->localeFacadeMock->expects(static::never())
            ->method('getCurrentLocale');

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getLocaleById')
            ->with($idLocale)
            ->willReturn($this->localeTransferMock);

        static::assertEquals(
            $this->localeTransferMock,
            $this->localeReader->getByNotificationCustomer($this->notificationCustomerTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByNotificationCustomerWithoutFKLocale(): void
    {
        $this->notificationCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getFkLocale')
            ->willReturn(null);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeFacadeMock->expects(static::never())
            ->method('getLocaleById');

        static::assertEquals(
            $this->localeTransferMock,
            $this->localeReader->getByNotificationCustomer($this->notificationCustomerTransferMock),
        );
    }
}
