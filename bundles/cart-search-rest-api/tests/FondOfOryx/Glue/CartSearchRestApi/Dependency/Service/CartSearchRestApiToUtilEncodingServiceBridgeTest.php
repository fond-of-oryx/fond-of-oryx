<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Dependency\Service;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class CartSearchRestApiToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected UtilEncodingServiceInterface|MockObject $serviceMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Dependency\Service\CartSearchRestApiToUtilEncodingServiceBridge
     */
    protected CartSearchRestApiToUtilEncodingServiceBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->serviceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CartSearchRestApiToUtilEncodingServiceBridge(
            $this->serviceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $json = '["foo", "bar"]';
        $data = json_decode($json, true);

        $this->serviceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with($data, null, null)
            ->willReturn($json);

        static::assertEquals($json, $this->bridge->encodeJson($data));
    }
}
