<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Communication\Plugin\ProductListSearchRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\CompanyTypeProductListSearchRestApiFacade;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ForeignCustomerSearchProductListQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\CompanyTypeProductListSearchRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyTypeProductListSearchRestApiFacade|MockObject $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Communication\Plugin\ProductListSearchRestApiExtension\ForeignCustomerSearchProductListQueryExpanderPlugin
     */
    protected ForeignCustomerSearchProductListQueryExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyTypeProductListSearchRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->plugin = new ForeignCustomerSearchProductListQueryExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandSearchProductListQuery')
            ->with($this->filterFieldTransferMocks, $this->queryJoinCollectionTransferMock)
            ->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand($this->filterFieldTransferMocks, $this->queryJoinCollectionTransferMock),
        );
    }
}
