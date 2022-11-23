<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface;

class CompanyReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReader
     */
    protected $companyReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyTypeProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyReader = new CompanyReader(
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetWhitelistedUuidsByCompanyUserIds(): void
    {
        $companyUserIds = [1, 2, 3];
        $whitelistedCompanyUuids = ['5615f7eb-6a54-4345-927f-6d3ed23d6f07', '965181d3-718d-47d0-a798-3b3daca1b073'];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getWhitelistedCompanyUuidsByCompanyUserIds')
            ->with($companyUserIds)
            ->willReturn($whitelistedCompanyUuids);

        static::assertEquals(
            $whitelistedCompanyUuids,
            $this->companyReader->getWhitelistedUuidsByCompanyUserIds($companyUserIds),
        );
    }
}
