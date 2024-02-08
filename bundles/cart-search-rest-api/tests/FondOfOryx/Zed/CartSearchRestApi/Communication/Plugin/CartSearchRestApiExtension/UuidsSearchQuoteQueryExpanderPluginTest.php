<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Communication\Plugin\CartSearchRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class UuidsSearchQuoteQueryExpanderPluginTest extends Unit
{
    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\QueryJoinCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QueryJoinCollectionTransfer|MockObject $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Communication\Plugin\CartSearchRestApiExtension\UuidsSearchQuoteQueryExpanderPlugin
     */
    protected UuidsSearchQuoteQueryExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new UuidsSearchQuoteQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CartSearchRestApiConstants::FILTER_FIELD_TYPE_UUIDS);

        static::assertTrue($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithInvalidFilterFieldTypes(): void
    {
        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('bar');

        static::assertFalse($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $uuids = ['foo', 'bar'];
        $uuidsAsJson = json_encode($uuids);

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CartSearchRestApiConstants::FILTER_FIELD_TYPE_UUIDS);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($uuidsAsJson);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->with(
                static::callback(
                    static function (QueryJoinTransfer $queryJoinTransfer) use ($uuidsAsJson) {
                        return $queryJoinTransfer->getWhereConditions()->count() === 1
                            && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyQuoteTableMap::COL_UUID
                            && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::IN
                            && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $uuidsAsJson;
                    },
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
