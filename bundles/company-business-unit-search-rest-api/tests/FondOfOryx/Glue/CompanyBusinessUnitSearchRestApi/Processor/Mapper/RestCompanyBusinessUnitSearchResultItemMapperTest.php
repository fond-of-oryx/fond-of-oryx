<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class RestCompanyBusinessUnitSearchResultItemMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $companyBusinessUnitListTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchResultItemMapper
     */
    protected $restCompanyBusinessUnitSearchResultItemMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitListTransferMock = $this->getMockBuilder(CompanyBusinessUnitListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitListTransferMocks = [
            $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanyBusinessUnitSearchResultItemMapper = new RestCompanyBusinessUnitSearchResultItemMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyBusinessUnitList(): void
    {
        $uuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a5';

        $this->companyBusinessUnitListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnits')
            ->willReturn(new ArrayObject($this->companyBusinessUnitListTransferMocks));

        $this->companyBusinessUnitListTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn(['uuid' => $uuid]);

        $restCompanyBusinessUnitSearchResultItemTransfers = $this->restCompanyBusinessUnitSearchResultItemMapper->fromCompanyBusinessUnitList(
            $this->companyBusinessUnitListTransferMock
        );

        static::assertCount(1, $restCompanyBusinessUnitSearchResultItemTransfers);

        static::assertEquals(
            $uuid,
            $restCompanyBusinessUnitSearchResultItemTransfers->offsetGet(0)->getUuid()
        );
    }
}
