<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface
     */
    protected MockObject|BusinessOnBehalfRestApiRepositoryInterface $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiToCompanyUserFacadeInterface|MockObject $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiToCompanyUserFacadeInterface|MockObject $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiToCompanyUserFacadeInterface|MockObject $restBusinessOnBehalfRequestTransfer;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReader
     */
    protected CompanyUserReader $companyUserReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserFacadeMock = $this->getMockBuilder(BusinessOnBehalfRestApiToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(BusinessOnBehalfRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestTransfer = $this->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReader = new CompanyUserReader(
            $this->companyUserFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByRestBusinessOnBehalfRequest(): void
    {
        $idCustomer = 1;
        $idCompanyUser = 1;
        $companyUserReference = 'company-user-reference';

        $this->restBusinessOnBehalfRequestTransfer->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restBusinessOnBehalfRequestTransfer->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUserByIdCustomerAndCompanyUserReference')
            ->with($idCustomer, $companyUserReference)
            ->willReturn($idCompanyUser);

        $this->companyUserFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUserById')
            ->with($idCompanyUser)
            ->willReturn($this->companyUserTransferMock);

        static::assertEquals(
            $this->companyUserTransferMock,
            $this->companyUserReader->getByRestBusinessOnBehalfRequest($this->restBusinessOnBehalfRequestTransfer),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestBusinessOnBehalfRequestWithInvalidCustomerid(): void
    {
        $idCustomer = null;
        $companyUserReference = 'company-user-reference';

        $this->restBusinessOnBehalfRequestTransfer->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restBusinessOnBehalfRequestTransfer->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        static::assertEquals(
            null,
            $this->companyUserReader->getByRestBusinessOnBehalfRequest($this->restBusinessOnBehalfRequestTransfer),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestBusinessOnBehalfRequestWithInvalidCompanyUserId(): void
    {
        $idCustomer = 1;
        $companyUserReference = 'company-user-reference';

        $this->restBusinessOnBehalfRequestTransfer->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restBusinessOnBehalfRequestTransfer->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUserByIdCustomerAndCompanyUserReference')
            ->with($idCustomer, $companyUserReference)
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->companyUserReader->getByRestBusinessOnBehalfRequest($this->restBusinessOnBehalfRequestTransfer),
        );
    }
}
