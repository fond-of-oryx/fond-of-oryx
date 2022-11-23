<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CustomerRegistrationRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientBridge
     */
    protected $customerRegistrationRestApiToZedRequestClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferMock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->url = 'url';

        $this->transferMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRestApiToZedRequestClientBridge = new CustomerRegistrationRestApiToZedRequestClientBridge(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $this->zedRequestClientMock->expects($this->atLeastOnce())
            ->method('call')
            ->with($this->url, $this->transferMock)
            ->willReturn($this->transferMock);

        $this->assertInstanceOf(
            TransferInterface::class,
            $this->customerRegistrationRestApiToZedRequestClientBridge->call(
                $this->url,
                $this->transferMock,
            ),
        );
    }
}
