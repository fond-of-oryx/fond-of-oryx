<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;

class CompanyUserReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected $companyUserReader;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restBusinessOnBehalfRequestTransfer;

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
