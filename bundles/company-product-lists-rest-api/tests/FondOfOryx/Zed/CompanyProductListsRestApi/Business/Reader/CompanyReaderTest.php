<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface;

class CompanyReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReader
     */
    protected $customerReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReader = new CompanyReader(
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetIdsByIdProductList(): void
    {
        $idProductList = 1;
        $customerIds = [1, 2, 4, 5];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyIdsByIdProductList')
            ->with($idProductList)
            ->willReturn($customerIds);

        static::assertEquals(
            $customerIds,
            $this->customerReader->getIdsByIdProductList($idProductList),
        );
    }
}
