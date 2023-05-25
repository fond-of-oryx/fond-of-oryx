<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepositoryInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyUserReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyUserSearchRestApiRepositoryInterface $repositoryMock;

    /**
     * @var array<(\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $searchCompanyUserQueryExpanderPluginMocks;

    /**
     * @var (\Generated\Shared\Transfer\CompanyUserListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyUserListTransfer $companyUserListTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader\CompanyUserReader
     */
    protected CompanyUserReader $companyUserReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyUserSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchCompanyUserQueryExpanderPluginMocks = [
            $this->getMockBuilder(SearchCompanyUserQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(SearchCompanyUserQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReader = new CompanyUserReader(
            $this->repositoryMock,
            $this->searchCompanyUserQueryExpanderPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testFindByCompanyUserList(): void
    {
        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($this->filterFieldTransferMocks));

        $this->searchCompanyUserQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($this->filterFieldTransferMocks)
            ->willReturn(false);

        $this->searchCompanyUserQueryExpanderPluginMocks[0]->expects(static::never())
            ->method('expand');

        $this->searchCompanyUserQueryExpanderPluginMocks[1]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($this->filterFieldTransferMocks)
            ->willReturn(true);

        $this->searchCompanyUserQueryExpanderPluginMocks[1]->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $this->filterFieldTransferMocks,
                static::callback(
                    static function (QueryJoinCollectionTransfer $queryJoinCollectionTransfer) {
                        return $queryJoinCollectionTransfer->getQueryJoins()->count() === 0;
                    },
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('setQueryJoins')
            ->with($this->queryJoinCollectionTransferMock)
            ->willReturn($this->companyUserListTransferMock);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('searchCompanyUser')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->companyUserListTransferMock);

        static::assertEquals(
            $this->companyUserListTransferMock,
            $this->companyUserReader->findByCompanyUserList($this->companyUserListTransferMock),
        );
    }
}
