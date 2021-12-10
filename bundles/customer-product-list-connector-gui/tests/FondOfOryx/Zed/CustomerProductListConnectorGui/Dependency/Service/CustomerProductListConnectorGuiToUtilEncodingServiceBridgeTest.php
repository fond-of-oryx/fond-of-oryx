<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class CustomerProductListConnectorGuiToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service\CustomerProductListConnectorGuiToUtilEncodingServiceInterface
     */
    protected $serviceBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $serviceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->serviceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceBridge = new CustomerProductListConnectorGuiToUtilEncodingServiceBridge(
            $this->serviceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $value = 'A string!';
        $encodedJson = json_encode($value);

        $this->serviceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->willReturn($encodedJson);

        $this->assertEquals(
            $encodedJson,
            $this->serviceBridge->encodeJson($value),
        );
    }

    /**
     * @return void
     */
    public function testDecodeJson(): void
    {
        $value = 'A string!';
        $decodedJson = ['A string!'];

        $this->serviceMock->expects(static::atLeastOnce())
            ->method('decodeJson')
            ->willReturn($decodedJson);

        $this->assertEquals(
            $decodedJson,
            $this->serviceBridge->decodeJson($value),
        );
    }
}
