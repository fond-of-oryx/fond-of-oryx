<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;

class RestCompanyRoleSearchResultItemMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyRoleListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\CompanyRoleTransfer>
     */
    protected $companyRoleTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchResultItemMapper
     */
    protected $restCompanyRoleSearchResultItemMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleListTransferMock = $this->getMockBuilder(CompanyRoleListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->restCompanyRoleSearchResultItemMapper = new RestCompanyRoleSearchResultItemMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyRoleList(): void
    {
        $uuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a5';
        $companyRoleTransferMocks = [$this->companyRoleTransferMock];

        $this->companyRoleListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->willReturn(new ArrayObject($companyRoleTransferMocks));

        $companyRoleTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $companyRoleTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn($uuid);

        $restCompanyRoleSearchResultItemTransfers = $this->restCompanyRoleSearchResultItemMapper->fromCompanyRoleList(
            $this->companyRoleListTransferMock,
        );

        static::assertCount(1, $restCompanyRoleSearchResultItemTransfers);

        static::assertEquals(
            $uuid,
            $restCompanyRoleSearchResultItemTransfers->offsetGet(0)->getCompanyUuid(),
        );
    }
}
