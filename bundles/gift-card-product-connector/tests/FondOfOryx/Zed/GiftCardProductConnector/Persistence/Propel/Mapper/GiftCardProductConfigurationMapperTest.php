<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration;

class GiftCardProductConfigurationMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapperInterface
     */
    protected $giftCardProductConfigurationMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration
     */
    protected $spyGiftCardProductConfigurationMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer
     */
    protected $spyGiftCardProductConfigurationTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spyGiftCardProductConfigurationMock = $this->getMockBuilder(SpyGiftCardProductConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationTransferMock = $this->getMockBuilder(SpyGiftCardProductConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationMapper = new GiftCardProductConfigurationMapper();
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->spyGiftCardProductConfigurationMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->spyGiftCardProductConfigurationTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with([])
            ->willReturn($this->spyGiftCardProductConfigurationTransferMock);

        $entityTransfer = $this->giftCardProductConfigurationMapper->mapEntityToTransfer(
            $this->spyGiftCardProductConfigurationMock,
            $this->spyGiftCardProductConfigurationTransferMock,
        );

        $this->assertEquals(
            $this->spyGiftCardProductConfigurationTransferMock,
            $entityTransfer,
        );

        $this->assertInstanceOf(
            SpyGiftCardProductConfigurationEntityTransfer::class,
            $entityTransfer,
        );
    }
}
