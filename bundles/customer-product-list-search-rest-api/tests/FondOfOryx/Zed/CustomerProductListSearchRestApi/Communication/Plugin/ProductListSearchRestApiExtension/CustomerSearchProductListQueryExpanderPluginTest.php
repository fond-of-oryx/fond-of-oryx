<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Communication\Plugin\ProductListSearchRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\CustomerProductListSearchRestApiFacade;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerSearchProductListQueryExpanderPluginTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\CustomerProductListSearchRestApiFacade&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerProductListSearchRestApiFacade|MockObject $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Communication\Plugin\ProductListSearchRestApiExtension\CustomerSearchProductListQueryExpanderPlugin
     */
    protected CustomerSearchProductListQueryExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CustomerProductListSearchRestApiFacade::class)
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

        $this->plugin = new CustomerSearchProductListQueryExpanderPlugin();
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
