<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyProductListSearchRestApi\CompanyProductListSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;

class CompanyUuidFilterTest extends Unit
{
    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilter
     */
    protected CompanyUuidFilter $companyUuidFilter;

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

        $this->companyUuidFilter = new CompanyUuidFilter();
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $companyUuid = '40c15179-1120-45c7-8179-27b16f2930a9';

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyProductListSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($companyUuid);

        static::assertEquals(
            $companyUuid,
            $this->companyUuidFilter->filter($this->filterFieldTransferMocks),
        );
    }
}
