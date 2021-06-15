<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use Codeception\Test\Unit;

class SplittableCheckoutRestApiConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = new SplittableCheckoutRestApiConfig();
    }

    /**
     * @return void
     */
    public function testGetPaymentProviderMethodToStateMachineMapping(): void
    {
        static::assertEmpty($this->config->getPaymentProviderMethodToStateMachineMapping());
    }
}
