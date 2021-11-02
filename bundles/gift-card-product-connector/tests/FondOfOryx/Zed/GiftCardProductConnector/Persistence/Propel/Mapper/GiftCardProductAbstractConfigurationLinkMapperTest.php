<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink;

class GiftCardProductAbstractConfigurationLinkMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface
     */
    protected $giftCardProductAbstractConfigurationLinkMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink
     */
    protected $spyGiftCardProductAbstractConfigurationLinkMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer
     */
    protected $spyGiftCardProductAbstractConfigurationLinkEntityTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spyGiftCardProductAbstractConfigurationLinkMock = $this->getMockBuilder(SpyGiftCardProductAbstractConfigurationLink::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock = $this->getMockBuilder(SpyGiftCardProductAbstractConfigurationLinkEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductAbstractConfigurationLinkMapper = new GiftCardProductAbstractConfigurationLinkMapper();
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->spyGiftCardProductAbstractConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with([])
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock);

        $entityTransfer = $this->giftCardProductAbstractConfigurationLinkMapper->mapEntityToTransfer(
            $this->spyGiftCardProductAbstractConfigurationLinkMock,
            $this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock,
        );

        $this->assertEquals(
            $this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock,
            $entityTransfer,
        );

        $this->assertInstanceOf(
            SpyGiftCardProductAbstractConfigurationLinkEntityTransfer::class,
            $entityTransfer,
        );
    }
}
