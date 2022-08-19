<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Dependency\Service;

use Codeception\Test\Unit;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Service\VertigoPriceProductPriceListToUtilEncodingServiceBridge;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class VertigoPriceProductPriceListToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $serviceMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Service\VertigoPriceProductPriceListToUtilEncodingServiceBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->serviceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new VertigoPriceProductPriceListToUtilEncodingServiceBridge(
            $this->serviceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $value = ['A string!'];
        $encodedJson = json_encode($value);

        $this->serviceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->willReturn($encodedJson);

        static::assertEquals(
            $encodedJson,
            $this->bridge->encodeJson($value),
        );
    }
}
