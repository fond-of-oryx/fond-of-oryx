<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLink;

class GiftCardProductConfigurationLinkMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapperInterface
     */
    protected $giftCardProductConfigurationLinkMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration
     */
    protected $spyGiftCardProductConfigurationLinkMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer
     */
    protected $spyGiftCardProductConfigurationLinkEntityTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spyGiftCardProductConfigurationLinkMock = $this->getMockBuilder(SpyGiftCardProductConfigurationLink::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationLinkEntityTransferMock = $this->getMockBuilder(SpyGiftCardProductConfigurationLinkEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationLinkMapper = new GiftCardProductConfigurationLinkMapper();
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->spyGiftCardProductConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->spyGiftCardProductConfigurationLinkEntityTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with([])
            ->willReturn($this->spyGiftCardProductConfigurationLinkEntityTransferMock);

        $entityTransfer = $this->giftCardProductConfigurationLinkMapper->mapEntityToTransfer(
            $this->spyGiftCardProductConfigurationLinkMock,
            $this->spyGiftCardProductConfigurationLinkEntityTransferMock
        );

        $this->assertEquals(
            $this->spyGiftCardProductConfigurationLinkEntityTransferMock,
            $entityTransfer
        );

        $this->assertInstanceOf(
            SpyGiftCardProductConfigurationLinkEntityTransfer::class,
            $entityTransfer
        );
    }
}
