<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface;

class CustomerReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReader
     */
    protected $customerReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReader = new CustomerReader(
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
            ->method('getCustomerIdsByIdProductList')
            ->with($idProductList)
            ->willReturn($customerIds);

        static::assertEquals(
            $customerIds,
            $this->customerReader->getIdsByIdProductList($idProductList),
        );
    }
}
