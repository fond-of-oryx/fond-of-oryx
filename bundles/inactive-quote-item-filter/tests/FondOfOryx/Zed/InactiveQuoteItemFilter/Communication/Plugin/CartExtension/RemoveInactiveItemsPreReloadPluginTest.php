<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\Plugin\CartExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\InactiveQuoteItemFilterCommunicationFactory;
use FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade\InactiveQuoteItemFilterToMessengerFacadeInterface;
use FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence\InactiveQuoteItemFilterRepository;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RemoveInactiveItemsPreReloadPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected StoreTransfer|MockObject $storeTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $itemTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence\InactiveQuoteItemFilterRepository
     */
    protected MockObject|InactiveQuoteItemFilterRepository $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\InactiveQuoteItemFilterCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected InactiveQuoteItemFilterCommunicationFactory|MockObject $factoryMock;

    /**
     * @var \FondOfOryx\Zed\InactiveQuoteItemFilter\Dependency\Facade\InactiveQuoteItemFilterToMessengerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected InactiveQuoteItemFilterToMessengerFacadeInterface|MockObject $messengerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\InactiveQuoteItemFilter\Communication\Plugin\CartExtension\RemoveInactiveItemsPreReloadPlugin
     */
    protected RemoveInactiveItemsPreReloadPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->repositoryMock = $this->getMockBuilder(InactiveQuoteItemFilterRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(InactiveQuoteItemFilterCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messengerFacadeMock = $this->getMockBuilder(InactiveQuoteItemFilterToMessengerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new RemoveInactiveItemsPreReloadPlugin();
        $this->plugin->setRepository($this->repositoryMock);
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPreReloadItems(): void
    {
        $storeName = 'FOO';
        $skus = ['12345-67890', '12345-67891'];
        $activeSkus = [$skus[1]];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[0]);

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($skus[1]);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getActiveSkusByStoreNameAndSkus')
            ->with($storeName, $skus)
            ->willReturn($activeSkus);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getMessengerFacade')
            ->willReturn($this->messengerFacadeMock);

        $this->messengerFacadeMock->expects(static::atLeastOnce())
            ->method('addInfoMessage')
            ->with(
                static::callback(
                    fn (
                        MessageTransfer $messageTransfer
                    ) => $messageTransfer->getValue() === RemoveInactiveItemsPreReloadPlugin::MESSAGE_INFO_CONCRETE_INACTIVE_PRODUCT_REMOVED
                        && $messageTransfer->getParameters() == [RemoveInactiveItemsPreReloadPlugin::MESSAGE_PARAM_SKU => $skus[0]],
                ),
            );

        static::assertEquals($this->quoteTransferMock, $this->plugin->preReloadItems($this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testPreReloadItemsWithoutStore(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getStore')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->repositoryMock->expects(static::never())
            ->method('getActiveSkusByStoreNameAndSkus');

        $this->factoryMock->expects(static::never())
            ->method('getMessengerFacade');

        $this->messengerFacadeMock->expects(static::never())
            ->method('addInfoMessage');

        static::assertEquals($this->quoteTransferMock, $this->plugin->preReloadItems($this->quoteTransferMock));
    }
}
