<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Dependency\Service;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ProductListSearchRestApiToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected UtilEncodingServiceInterface|MockObject $serviceMock;

    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Dependency\Service\ProductListSearchRestApiToUtilEncodingServiceBridge
     */
    protected ProductListSearchRestApiToUtilEncodingServiceBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->serviceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ProductListSearchRestApiToUtilEncodingServiceBridge(
            $this->serviceMock,
        );
    }

    /**
     * @return void
     */
    public function testDecodeJson(): void
    {
        $json = '["foo", "bar"]';
        $data = json_decode($json, true);

        $this->serviceMock->expects(static::atLeastOnce())
            ->method('decodeJson')
            ->with($json, true, null, null)
            ->willReturn($data);

        static::assertEquals($data, $this->bridge->decodeJson($json, true));
    }
}
