<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration;

class GiftCardProductAbstractConfigurationMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface
     */
    protected $giftCardProductAbstractConfigurationMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration
     */
    protected $spyGiftCardProductAbstractConfigurationMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer
     */
    protected $spyGiftCardProductAbstractConfigurationTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spyGiftCardProductAbstractConfigurationMock = $this->getMockBuilder(SpyGiftCardProductAbstractConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationTransferMock = $this->getMockBuilder(SpyGiftCardProductAbstractConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductAbstractConfigurationMapper = new GiftCardProductAbstractConfigurationMapper();
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->spyGiftCardProductAbstractConfigurationMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->spyGiftCardProductAbstractConfigurationTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with([])
            ->willReturn($this->spyGiftCardProductAbstractConfigurationTransferMock);

        $entityTransfer = $this->giftCardProductAbstractConfigurationMapper->mapEntityToTransfer(
            $this->spyGiftCardProductAbstractConfigurationMock,
            $this->spyGiftCardProductAbstractConfigurationTransferMock,
        );

        $this->assertEquals(
            $this->spyGiftCardProductAbstractConfigurationTransferMock,
            $entityTransfer,
        );

        $this->assertInstanceOf(
            SpyGiftCardProductAbstractConfigurationEntityTransfer::class,
            $entityTransfer,
        );
    }
}
