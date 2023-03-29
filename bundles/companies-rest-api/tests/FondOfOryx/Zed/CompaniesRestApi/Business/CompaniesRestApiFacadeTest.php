<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleterInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompaniesRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Business\CompaniesRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyDeleterMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Business\CompaniesRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompaniesRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyDeleterMock = $this->getMockBuilder(CompanyDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompaniesRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompany(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyDeleter')
            ->willReturn($this->companyDeleterMock);

        $this->companyDeleterMock->expects(static::atLeastOnce())
            ->method('deleteCompany')
            ->with($this->companyTransferMock)
            ->willReturn($this->companyTransferMock);

        static::assertEquals(
            $this->companyTransferMock,
            $this->facade->deleteCompany($this->companyTransferMock),
        );
    }
}
