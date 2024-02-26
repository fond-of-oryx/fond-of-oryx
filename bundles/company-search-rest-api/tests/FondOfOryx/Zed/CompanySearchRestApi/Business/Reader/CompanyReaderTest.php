<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepositoryInterface;
use FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\CompanyExpanderPluginInterface;
use FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CompanyReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanySearchRestApiRepositoryInterface $repositoryMock;

    /**
     * @var array<(\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $searchCompanyQueryExpanderPluginMocks;

    /**
     * @var array<\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\CompanyExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $companyExpanderPluginMocks;

    /**
     * @var (\Generated\Shared\Transfer\CompanyListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyListTransfer $companyListTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $companyTransferMocks;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanySearchRestApi\Business\Reader\CompanyReader
     */
    protected CompanyReader $companyReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanySearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchCompanyQueryExpanderPluginMocks = [
            $this->getMockBuilder(SearchCompanyQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(SearchCompanyQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->companyExpanderPluginMocks = [
            $this->getMockBuilder(CompanyExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
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

        $this->companyTransferMocks = [
            $this->getMockBuilder(CompanyTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->companyReader = new CompanyReader(
            $this->repositoryMock,
            $this->searchCompanyQueryExpanderPluginMocks,
            $this->companyExpanderPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testFindByCompanyList(): void
    {
        $this->companyListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($this->filterFieldTransferMocks));

        $this->searchCompanyQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($this->filterFieldTransferMocks)
            ->willReturn(false);

        $this->searchCompanyQueryExpanderPluginMocks[0]->expects(static::never())
            ->method('expand');

        $this->searchCompanyQueryExpanderPluginMocks[1]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($this->filterFieldTransferMocks)
            ->willReturn(true);

        $this->searchCompanyQueryExpanderPluginMocks[1]->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $this->filterFieldTransferMocks,
                static::callback(
                    static function (QueryJoinCollectionTransfer $queryJoinCollectionTransfer) {
                        return $queryJoinCollectionTransfer->getQueryJoins()->count() === 0;
                    },
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        $this->companyListTransferMock->expects(static::atLeastOnce())
            ->method('setQueryJoins')
            ->with($this->queryJoinCollectionTransferMock)
            ->willReturn($this->companyListTransferMock);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('searchCompanies')
            ->with($this->companyListTransferMock)
            ->willReturn($this->companyListTransferMock);

        $this->companyListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanies')
            ->willReturn(new ArrayObject($this->companyTransferMocks));

        $this->companyExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->companyTransferMocks[0])
            ->willReturn($this->companyTransferMocks[0]);

        static::assertEquals(
            $this->companyListTransferMock,
            $this->companyReader->findByCompanyList($this->companyListTransferMock),
        );
    }
}
