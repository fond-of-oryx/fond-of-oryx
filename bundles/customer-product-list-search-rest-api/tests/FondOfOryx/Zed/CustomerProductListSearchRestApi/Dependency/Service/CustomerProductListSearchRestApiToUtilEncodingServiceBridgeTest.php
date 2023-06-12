<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class CustomerProductListSearchRestApiToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected UtilEncodingServiceInterface|MockObject $serviceMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceBridge
     */
    protected CustomerProductListSearchRestApiToUtilEncodingServiceBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->serviceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CustomerProductListSearchRestApiToUtilEncodingServiceBridge(
            $this->serviceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $data = ['foo', 'bar'];
        $json = json_encode($data);

        $this->serviceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with($data)
            ->willReturn($json);

        static::assertEquals($json, $this->bridge->encodeJson($data));
    }
}
