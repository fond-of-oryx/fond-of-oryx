<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ErpOrderPageSearchToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected $erpOrderPageSearchToUtilEncodingServiceBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->utilEncodingServiceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToUtilEncodingServiceBridge = new ErpOrderPageSearchToUtilEncodingServiceBridge(
            $this->utilEncodingServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $value = 'A string!';
        $encodedJson = json_encode($value);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->willReturn($encodedJson);

        $this->assertEquals(
            $encodedJson,
            $this->erpOrderPageSearchToUtilEncodingServiceBridge->encodeJson($value),
        );
    }

    /**
     * @return void
     */
    public function testDecodeJson(): void
    {
        $value = 'A string!';
        $decodedJson = ['A string!'];

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('decodeJson')
            ->willReturn($decodedJson);

        $this->assertEquals(
            $decodedJson,
            $this->erpOrderPageSearchToUtilEncodingServiceBridge->decodeJson($value),
        );
    }
}
