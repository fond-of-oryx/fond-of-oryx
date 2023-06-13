<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;

class IdCustomerFilterTest extends Unit
{
    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilter
     */
    protected IdCustomerFilter $idCustomerFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->idCustomerFilter = new IdCustomerFilter();
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $idCustomer = 1;

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyTypeProductListSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($idCustomer);

        static::assertEquals(
            $idCustomer,
            $this->idCustomerFilter->filter($this->filterFieldTransferMocks),
        );
    }
}
