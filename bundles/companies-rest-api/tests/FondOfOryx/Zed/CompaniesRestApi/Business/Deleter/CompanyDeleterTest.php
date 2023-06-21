<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business\Deleter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyDeleter\CompanyDeleterConstants;
use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface;
use FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyDeleterFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleter
     */
    protected $companyDeleter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyDeleterFacadeMock = $this->getMockBuilder(CompaniesRestApiToCompanyDeleterFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompaniesRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyDeleter = new CompanyDeleter(
            $this->companyDeleterFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompanySuccess(): void
    {
        $uuid = 'uuid';
        $companyId = 1;
        $state = 'deleted';

        $delResponse = [
            CompanyDeleterConstants::SUCCESS_IDS => [
                0 => $companyId,
            ],
        ];

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCompanyByUuid')
            ->with($uuid)
            ->willReturn($companyId);

        $this->companyDeleterFacadeMock->expects(static::atLeastOnce())
            ->method('deleteCompany')
            ->with($companyId)
            ->willReturn($delResponse);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($companyId);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('setStatus')
            ->with($state)
            ->willReturnSelf();

        $this->companyDeleter->deleteCompany($this->companyTransferMock);
    }
}
