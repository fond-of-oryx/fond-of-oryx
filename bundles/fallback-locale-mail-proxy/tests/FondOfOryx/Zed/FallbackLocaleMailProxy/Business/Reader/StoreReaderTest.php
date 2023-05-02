<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class StoreReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FallbackLocaleMailProxyToStoreFacadeInterface $storeFacadeMock;

    /**
     * @var (\Generated\Shared\Transfer\MailTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailTransfer $mailTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\StoreTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected StoreTransfer|MockObject $storeTransferMock;

    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReader
     */
    protected StoreReader $storeReader;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->storeFacadeMock = $this->getMockBuilder(FallbackLocaleMailProxyToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeReader = new StoreReader($this->storeFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetByMail(): void
    {
        $storeName = 'STORE';

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getStoreName')
            ->willReturn($storeName);

        $this->storeFacadeMock->expects(static::never())
            ->method('getCurrentStore');

        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getStoreByName')
            ->with($storeName)
            ->willReturn($this->storeTransferMock);

        static::assertEquals(
            $this->storeTransferMock,
            $this->storeReader->getByMail($this->mailTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByMailWithoutStoreName(): void
    {
        $storeName = null;

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getStoreName')
            ->willReturn($storeName);

        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeFacadeMock->expects(static::never())
            ->method('getStoreByName');

        static::assertEquals(
            $this->storeTransferMock,
            $this->storeReader->getByMail($this->mailTransferMock),
        );
    }
}
