<?php

namespace FondOfOryx\Zed\GiftCardApi\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryContainerInterface;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerInterface;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery;

class GiftCardApiRepositoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardQueryContainerMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardQueryMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCard|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepositoryInterface
     */
    protected $repository;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(GiftCardApiPersistenceFactory::class)->disableOriginalConstructor()->getMock();
        $this->queryContainerMock = $this->getMockBuilder(GiftCardApiToApiQueryContainerInterface::class)->disableOriginalConstructor()->getMock();
        $this->giftCardQueryContainerMock = $this->getMockBuilder(GiftCardApiToGiftCardQueryContainerInterface::class)->disableOriginalConstructor()->getMock();
        $this->spyGiftCardQueryMock = $this->getMockBuilder(SpyGiftCardQuery::class)->disableOriginalConstructor()->getMock();
        $this->spyGiftCardMock = $this->getMockBuilder(SpyGiftCardQuery::class)->disableOriginalConstructor()->getMock();

        $this->repository = new GiftCardApiRepository();
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindGiftCardByCodeFindNothing(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())->method('getGiftCardQueryContainer')->willReturn($this->giftCardQueryContainerMock);
        $this->giftCardQueryContainerMock->expects(static::once())->method('queryGiftCardByCode')->willReturn($this->spyGiftCardQueryMock);
        $this->spyGiftCardQueryMock->expects(static::once())->method('findOne')->willReturn(null);

        $this->repository->findGiftCardByCode('code');
    }
}
