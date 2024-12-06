<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Shared\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiConstants;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserReaderInterface|MockObject $companyUserReaderMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface $businessOnBehalfFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserTransfer|MockObject $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserResponseTransfer|MockObject $companyUserResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriter
     */
    protected CompanyUserWriter $companyUserWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserReaderMock = $this->getMockBuilder(CompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessOnBehalfFacadeMock = $this->getMockBuilder(BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserWriter = new CompanyUserWriter(
            $this->companyUserReaderMock,
            $this->businessOnBehalfFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testSetDefaultByRestBusinessOnBehalfRequest(): void
    {
        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->businessOnBehalfFacadeMock->expects(static::atLeastOnce())
            ->method('unsetDefaultCompanyUserByCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        $this->businessOnBehalfFacadeMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUser')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserResponseTransferMock);

        $restBusinessOnBehalfResponseTransfer = $this->companyUserWriter->setDefaultByRestBusinessOnBehalfRequest(
            $this->restBusinessOnBehalfRequestTransferMock,
        );

        static::assertEmpty($restBusinessOnBehalfResponseTransfer->getErrors());
        static::assertTrue($restBusinessOnBehalfResponseTransfer->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testSetDefaultByRestBusinessOnBehalfRequestWithoutExistingCompanyUser(): void
    {
        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn(null);

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('unsetDefaultCompanyUserByCustomer');

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('setDefaultCompanyUser');

        $restBusinessOnBehalfResponseTransfer = $this->companyUserWriter->setDefaultByRestBusinessOnBehalfRequest(
            $this->restBusinessOnBehalfRequestTransferMock,
        );

        static::assertCount(1, $restBusinessOnBehalfResponseTransfer->getErrors());
        static::assertFalse($restBusinessOnBehalfResponseTransfer->getIsSuccessful());
        static::assertEquals(
            BusinessOnBehalfRestApiConstants::ERROR_CODE_COMPANY_USER_NOT_FOUND,
            $restBusinessOnBehalfResponseTransfer->getErrors()[0]->getErrorCode(),
        );
        static::assertEquals(
            BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_COMPANY_USER_NOT_FOUND,
            $restBusinessOnBehalfResponseTransfer->getErrors()[0]->getMessage(),
        );
    }

    /**
     * @return void
     */
    public function testSetDefaultByRestBusinessOnBehalfRequestWithInvalidCompanyUser(): void
    {
        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('unsetDefaultCompanyUserByCustomer');

        $this->businessOnBehalfFacadeMock->expects(static::never())
            ->method('setDefaultCompanyUser');

        $restBusinessOnBehalfResponseTransfer = $this->companyUserWriter->setDefaultByRestBusinessOnBehalfRequest(
            $this->restBusinessOnBehalfRequestTransferMock,
        );

        static::assertCount(1, $restBusinessOnBehalfResponseTransfer->getErrors());
        static::assertFalse($restBusinessOnBehalfResponseTransfer->getIsSuccessful());
        static::assertEquals(
            BusinessOnBehalfRestApiConstants::ERROR_CODE_INVALID_COMPANY_USER,
            $restBusinessOnBehalfResponseTransfer->getErrors()[0]->getErrorCode(),
        );
        static::assertEquals(
            BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_INVALID_COMPANY_USER,
            $restBusinessOnBehalfResponseTransfer->getErrors()[0]->getMessage(),
        );
    }
}
