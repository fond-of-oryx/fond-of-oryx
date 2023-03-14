<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleter\Business\Model\CompanyDeleterInterface;

class CompanyDeleterFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\Model\CompanyDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyDeleterMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyDeleterBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyDeleterMock = $this->getMockBuilder(CompanyDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyDeleterFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanies(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyDeleter')
            ->willReturn($this->companyDeleterMock);

        $this->companyDeleterMock->expects(static::atLeastOnce())
            ->method('delete')
            ->willReturn([]);

        static::assertEquals(
            [],
            $this->facade->deleteCompanies([1]),
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompany(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyDeleter')
            ->willReturn($this->companyDeleterMock);

        $this->companyDeleterMock->expects(static::atLeastOnce())
            ->method('delete')
            ->willReturn([]);

        static::assertEquals(
            [],
            $this->facade->deleteCompany(1),
        );
    }
}
