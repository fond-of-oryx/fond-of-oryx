<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Communication\Plugin\CreditMemoExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCard;
use Propel\Runtime\Collection\ObjectCollection;

class GiftCardCreditMemoMapperExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Communication\Plugin\CreditMemoExtension\GiftCardCreditMemoMapperExpanderPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $creditMemoEntityMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCard|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $creditMemoGiftCardEntityMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->creditMemoTransferMock = $this
            ->getMockBuilder(CreditMemoTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoEntityMock = $this
            ->getMockBuilder(FooCreditMemo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoGiftCardEntityMock = $this
            ->getMockBuilder(FooCreditMemoGiftCard::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardCreditMemoMapperExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $creditMemoGiftCards = new ObjectCollection();
        $creditMemoGiftCards->append($this->creditMemoGiftCardEntityMock);

        $this->creditMemoEntityMock->expects(static::atLeastOnce())
            ->method('hasGiftCards')
            ->willReturn(true);

        $this->creditMemoEntityMock->expects(static::atLeastOnce())
            ->method('getFooCreditMemoGiftCards')
            ->willReturn($creditMemoGiftCards);

        $this->creditMemoGiftCardEntityMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCards')
            ->willReturnSelf();

        static::assertInstanceOf(
            CreditMemoTransfer::class,
            $this->plugin->expand($this->creditMemoEntityMock, $this->creditMemoTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNoGiftCards(): void
    {
        $this->creditMemoEntityMock->expects(static::atLeastOnce())
            ->method('hasGiftCards')
            ->willReturn(false);

        static::assertInstanceOf(
            CreditMemoTransfer::class,
            $this->plugin->expand($this->creditMemoEntityMock, $this->creditMemoTransferMock),
        );
    }
}
