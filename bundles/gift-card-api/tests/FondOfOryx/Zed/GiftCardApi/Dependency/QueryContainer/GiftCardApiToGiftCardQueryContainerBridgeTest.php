<?php

namespace FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery;
use Spryker\Zed\GiftCard\Persistence\GiftCardQueryContainerInterface;

class GiftCardApiToGiftCardQueryContainerBridgeTest extends Unit
{
    /**
     * @var \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $abstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerBridge
     */
    protected $giftCardQueryContainerBridge;

    /**
     * @var \Spryker\Zed\GiftCard\Persistence\GiftCardQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->queryContainerMock = $this
            ->getMockBuilder(GiftCardQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardQueryMock = $this->getMockBuilder(SpyGiftCardQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardQueryContainerBridge =
            new GiftCardApiToGiftCardQueryContainerBridge($this->queryContainerMock);
    }

    /**
     * @return void
     */
    public function testQueryGiftCardByCode(): void
    {
        $code = 'code';
        $this->queryContainerMock->expects(static::atLeastOnce())
            ->method('queryGiftCardByCode')
            ->with($code)
            ->willReturn($this->spyGiftCardQueryMock);

        static::assertInstanceOf(
            SpyGiftCardQuery::class,
            $this->giftCardQueryContainerBridge->queryGiftCardByCode($code),
        );
    }

    /**
     * @return void
     */
    public function testGetGiftCardQuery(): void
    {
        $this->queryContainerMock->expects(static::atLeastOnce())
            ->method('queryGiftCards')
            ->willReturn($this->spyGiftCardQueryMock);

        static::assertInstanceOf(
            SpyGiftCardQuery::class,
            $this->giftCardQueryContainerBridge->getGiftCardQuery(),
        );
    }
}
