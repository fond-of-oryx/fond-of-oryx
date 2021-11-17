<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class JellyfishSalesOrderToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface
     */
    protected $utilEncodingServiceBridge;

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

        $this->utilEncodingServiceBridge = new JellyfishSalesOrderToUtilEncodingServiceBridge(
            $this->utilEncodingServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $value = ['A string!'];
        $encodedJson = json_encode($value);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->willReturn($encodedJson);

        static::assertEquals(
            $encodedJson,
            $this->utilEncodingServiceBridge->encodeJson($value),
        );
    }
}
