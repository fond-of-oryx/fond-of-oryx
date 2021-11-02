<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

class RestCompanySearchResultItemMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyListTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\CompanyTransfer>
     */
    protected $companyTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchResultItemMapper
     */
    protected $restCompanySearchResultItemMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMocks = [
            $this->getMockBuilder(CompanyTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanySearchResultItemMapper = new RestCompanySearchResultItemMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyList(): void
    {
        $uuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a5';

        $this->companyListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanies')
            ->willReturn(new ArrayObject($this->companyTransferMocks));

        $this->companyTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $restCompanySearchResultItemTransfers = $this->restCompanySearchResultItemMapper->fromCompanyList(
            $this->companyListTransferMock,
        );

        static::assertCount(1, $restCompanySearchResultItemTransfers);

        static::assertEquals(
            $uuid,
            $restCompanySearchResultItemTransfers->offsetGet(0)->getId(),
        );
    }
}
