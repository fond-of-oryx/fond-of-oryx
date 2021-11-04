<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class RestCompanyUserSearchResultItemMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserListTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\CompanyUserTransfer>
     */
    protected $companyUserTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchResultItemMapper
     */
    protected $restCompanyUserSearchResultItemMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMocks = [
            $this->getMockBuilder(CompanyUserTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanyUserSearchResultItemMapper = new RestCompanyUserSearchResultItemMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyUserList(): void
    {
        $uuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a5';

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn(new ArrayObject($this->companyUserTransferMocks));

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn($uuid);

        $restCompanyUserSearchResultItemTransfers = $this->restCompanyUserSearchResultItemMapper->fromCompanyUserList(
            $this->companyUserListTransferMock,
        );

        static::assertCount(1, $restCompanyUserSearchResultItemTransfers);

        static::assertEquals(
            $uuid,
            $restCompanyUserSearchResultItemTransfers->offsetGet(0)->getCompanyId(),
        );
    }
}
