<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;

class CompanyBusinessUnitUuidFilterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilter
     */
    protected $companyBusinessUnitUuidFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitUuidFilter = new CompanyBusinessUnitUuidFilter();
    }

    /**
     * @return void
     */
    public function testFilterByFilterField(): void
    {
        $companyBusinessUnitUuid = 'd5ffcf7e-183f-4aa1-819e-74acf9f6a134';

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID);

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($companyBusinessUnitUuid);

        static::assertEquals(
            $companyBusinessUnitUuid,
            $this->companyBusinessUnitUuidFilter->filterByFilterField($this->filterFieldTransferMock),
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
            $this->companyBusinessUnitUuidFilter->filterByFilterField($this->filterFieldTransferMock),
        );
    }
}
