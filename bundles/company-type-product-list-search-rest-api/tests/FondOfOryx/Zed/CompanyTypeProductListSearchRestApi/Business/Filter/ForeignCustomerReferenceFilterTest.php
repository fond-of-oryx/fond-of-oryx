<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;

class ForeignCustomerReferenceFilterTest extends Unit
{
    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilter
     */
    protected ForeignCustomerReferenceFilter $foreignCustomerReferenceFilter;

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

        $this->foreignCustomerReferenceFilter = new ForeignCustomerReferenceFilter();
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $customerReference = 'FOO-1';

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyTypeProductListSearchRestApiConstants::FILTER_FIELD_TYPE_FOREIGN_CUSTOMER_REFERENCE);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($customerReference);

        static::assertEquals(
            $customerReference,
            $this->foreignCustomerReferenceFilter->filter($this->filterFieldTransferMocks),
        );
    }
}
