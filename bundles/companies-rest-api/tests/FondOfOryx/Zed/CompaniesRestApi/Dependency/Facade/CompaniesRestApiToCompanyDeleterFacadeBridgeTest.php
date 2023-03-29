<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacadeInterface;

class CompaniesRestApiToCompanyDeleterFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompaniesRestApiToCompanyDeleterFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompany(): void
    {
        $companyId = 1;

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('deleteCompany')
            ->with($companyId)
            ->willReturn([]);

        static::assertEquals(
            [],
            $this->bridge->deleteCompany($companyId),
        );
    }
}
