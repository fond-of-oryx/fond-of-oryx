<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface;

class CustomerReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReader
     */
    protected $customerReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyTypeProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReader = new CustomerReader(
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetWhitelistedUuidsByCompanyUserIds(): void
    {
        $companyUserIds = [1, 2, 3];
        $whitelistedCustomerReferences = ['FOO--1', 'FOO--10'];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getWhitelistedCustomerReferencesByCompanyUserIds')
            ->with($companyUserIds)
            ->willReturn($whitelistedCustomerReferences);

        static::assertEquals(
            $whitelistedCustomerReferences,
            $this->customerReader->getWhitelistedReferencesByCompanyUserIds($companyUserIds),
        );
    }
}
