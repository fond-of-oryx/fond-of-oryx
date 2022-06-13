<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;

class IdCustomerFilterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilter
     */
    protected $idCustomerFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCustomerFilter = new IdCustomerFilter();
    }

    /**
     * @return void
     */
    public function testFilterByFilterField(): void
    {
        $idCustomer = 1;

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($idCustomer);

        static::assertEquals(
            $idCustomer,
            $this->idCustomerFilter->filterByFilterField($this->filterFieldTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFilterByFilterFieldWithInvalidType(): void
    {
        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMock->expects(static::never())
            ->method('getValue');

        static::assertEquals(
            null,
            $this->idCustomerFilter->filterByFilterField($this->filterFieldTransferMock),
        );
    }
}
