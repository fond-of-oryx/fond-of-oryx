<?php

namespace FondOfOryx\Zed\GiftCardApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiFacade;
use FondOfOryx\Zed\GiftCardApi\GiftCardApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\Business\Exception\ApiDispatchingException;

class GiftCardApiResourcePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Communication\Plugin\Api\GiftCardApiResourcePlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(GiftCardApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardApiResourcePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->expectException(ApiDispatchingException::class);

        $this->plugin->get(1);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->expectException(ApiDispatchingException::class);

        $this->plugin->update(1, $this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->expectException(ApiDispatchingException::class);

        $this->plugin->add($this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->expectException(ApiDispatchingException::class);

        $this->plugin->remove(1);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findGiftCard')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->plugin->find($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(GiftCardApiConfig::RESOURCE_GIFT_CARD, $this->plugin->getResourceName());
    }
}
