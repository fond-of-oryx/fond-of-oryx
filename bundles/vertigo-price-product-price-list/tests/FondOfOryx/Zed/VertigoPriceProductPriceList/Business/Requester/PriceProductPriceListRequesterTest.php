<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester;

use Codeception\Test\Unit;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface;
use Generated\Shared\Transfer\VertigoPriceApiRequestTransfer;
use Generated\Shared\Transfer\VertigoPriceApiResponseTransfer;

class PriceProductPriceListRequesterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $vertigoPriceApiAdapterMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\VertigoPriceApiResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $vertigoPriceApiResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequester
     */
    protected $priceProductPriceListRequester;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->vertigoPriceApiAdapterMock = $this->getMockBuilder(VertigoPriceApiAdapterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(VertigoPriceProductPriceListRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->vertigoPriceApiResponseTransferMock = $this->getMockBuilder(VertigoPriceApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceProductPriceListRequester = new PriceProductPriceListRequester(
            $this->vertigoPriceApiAdapterMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testRequestAllMissing(): void
    {
        $skus = ['foo-bar-1', 'foo-bar-2'];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getSkusWithoutPriceProductPriceList')
            ->willReturn($skus);

        $this->vertigoPriceApiAdapterMock->expects(static::atLeastOnce())
            ->method('sendRequest')
            ->with(
                static::callback(
                    static function (VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer) use ($skus) {
                        return $vertigoPriceApiRequestTransfer->getBody()['skus'] === $skus;
                    },
                ),
            )->willReturn($this->vertigoPriceApiResponseTransferMock);

        $this->priceProductPriceListRequester->requestAllMissing();
    }

    /**
     * @return void
     */
    public function testRequestAllMissingWithoutSkus(): void
    {
        $skus = [];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getSkusWithoutPriceProductPriceList')
            ->willReturn($skus);

        $this->vertigoPriceApiAdapterMock->expects(static::never())
            ->method('sendRequest');

        $this->priceProductPriceListRequester->requestAllMissing();
    }
}
