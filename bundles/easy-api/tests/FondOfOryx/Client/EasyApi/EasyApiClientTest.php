<?php

namespace FondOfOryx\Client\EasyApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\EasyApi\Zed\EasyApiZedStubInterface;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class EasyApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\EasyApi\EasyApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|EasyApiFactory $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiRequestTransfer|MockObject $easyApiRequestTransfer;

    /**
     * @var \Generated\Shared\Transfer\EasyApiFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiFilterTransfer|MockObject $easyApiFilterTransfer;

    /**
     * @var \Generated\Shared\Transfer\EasyApiResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiResponseTransfer|MockObject $easyApiResponseTransfer;

    /**
     * @var \FondOfOryx\Client\EasyApi\Zed\EasyApiZedStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiZedStubInterface|MockObject $zedStubMock;

    /**
     * @var \FondOfOryx\Client\EasyApi\EasyApiClient
     */
    protected EasyApiClient $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(EasyApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiRequestTransfer = $this->getMockBuilder(EasyApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiFilterTransfer = $this->getMockBuilder(EasyApiFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiResponseTransfer = $this->getMockBuilder(EasyApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(EasyApiZedStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new EasyApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetDocument(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createEasyApiZedStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('getDocument')
            ->with($this->easyApiRequestTransfer)
            ->willReturn($this->easyApiResponseTransfer);

        static::assertEquals(
            $this->easyApiResponseTransfer,
            $this->client->getDocument(
                $this->easyApiRequestTransfer,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFindDocument(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createEasyApiZedStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('findDocument')
            ->with($this->easyApiFilterTransfer)
            ->willReturn($this->easyApiResponseTransfer);

        static::assertEquals(
            $this->easyApiResponseTransfer,
            $this->client->findDocument(
                $this->easyApiFilterTransfer,
            ),
        );
    }
}
