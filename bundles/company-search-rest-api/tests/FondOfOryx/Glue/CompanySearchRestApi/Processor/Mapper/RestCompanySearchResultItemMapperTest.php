<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\RestCompanySearchResultItemExpanderInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanySearchResultItemTransfer;
use PHPUnit\Framework\MockObject\MockObject;

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
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\RestCompanySearchResultItemExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestCompanySearchResultItemExpanderInterface|MockObject $companySearchResultItemExpanderMock;

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

        $this->companySearchResultItemExpanderMock = $this->getMockBuilder(RestCompanySearchResultItemExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMocks = [
            $this->getMockBuilder(CompanyTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanySearchResultItemMapper = new RestCompanySearchResultItemMapper($this->companySearchResultItemExpanderMock);
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

        $this->companySearchResultItemExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->willReturnCallback(static function (
                RestCompanySearchResultItemTransfer $restCompanySearchResultItemTransfer,
                CompanyTransfer $companyTransfer
            ) {
                return $restCompanySearchResultItemTransfer;
            });

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
