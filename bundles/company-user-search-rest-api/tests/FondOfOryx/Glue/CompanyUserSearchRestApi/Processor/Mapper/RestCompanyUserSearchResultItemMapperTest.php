<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
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
     * @var \Generated\Shared\Transfer\CompanyRoleCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleCollectionTransferMock;

    /**
     * @var array<(\PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleTransfer)>
     */
    protected $companyRoleTransferMocks;

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

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMocks = [
            $this->getMockBuilder(CompanyRoleTransfer::class)
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
        $companyUuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a5';
        $companyRoleUuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a2';

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn(new ArrayObject($this->companyUserTransferMocks));

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn($companyUuid);

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionTransferMock);

        $this->companyRoleCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn(new ArrayObject($this->companyRoleTransferMocks));

        $this->companyRoleTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($companyRoleUuid);

        $this->companyRoleTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $restCompanyUserSearchResultItemTransfers = $this->restCompanyUserSearchResultItemMapper->fromCompanyUserList(
            $this->companyUserListTransferMock,
        );

        static::assertCount(1, $restCompanyUserSearchResultItemTransfers);
        static::assertCount(1, $restCompanyUserSearchResultItemTransfers->offsetGet(0)->getCompanyRoles());

        static::assertEquals(
            $companyUuid,
            $restCompanyUserSearchResultItemTransfers->offsetGet(0)->getCompanyId(),
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyUserListWithoutCompanyRoles(): void
    {
        $companyUuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a5';

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn(new ArrayObject($this->companyUserTransferMocks));

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn($companyUuid);

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn(null);

        $restCompanyUserSearchResultItemTransfers = $this->restCompanyUserSearchResultItemMapper->fromCompanyUserList(
            $this->companyUserListTransferMock,
        );

        static::assertCount(1, $restCompanyUserSearchResultItemTransfers);
        static::assertCount(0, $restCompanyUserSearchResultItemTransfers->offsetGet(0)->getCompanyRoles());

        static::assertEquals(
            $companyUuid,
            $restCompanyUserSearchResultItemTransfers->offsetGet(0)->getCompanyId(),
        );
    }
}
