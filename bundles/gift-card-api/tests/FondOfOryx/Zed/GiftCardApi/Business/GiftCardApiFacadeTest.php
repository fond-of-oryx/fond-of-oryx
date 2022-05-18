<?php

namespace FondOfOryx\Zed\GiftCardApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Business\Model\GiftCardApiInterface;
use FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class GiftCardApiFacadeTest extends Unit
{
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
     * @var \FondOfOryx\Zed\GiftCardApi\Business\Model\GiftCardApiInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardApiMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiFacade
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardApiValidatorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(GiftCardApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardApiMock = $this->getMockBuilder(GiftCardApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardApiValidatorMock = $this->getMockBuilder(GiftCardApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new GiftCardApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindGiftCard(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardApi')
            ->willReturn($this->giftCardApiMock);

        $this->giftCardApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->facade->findGiftCard($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardApiValidator')
            ->willReturn($this->giftCardApiValidatorMock);

        $this->giftCardApiValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        static::assertIsArray($this->facade->validate($this->apiDataTransferMock));
    }
}
