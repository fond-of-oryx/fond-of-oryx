<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi;

use Codeception\Test\Unit;

class SplittableTotalsRestApiConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = new SplittableTotalsRestApiConfig();
    }

    /**
     * @return void
     */
    public function testGetPaymentProviderMethodToStateMachineMapping(): void
    {
        static::assertEmpty($this->config->getPaymentProviderMethodToStateMachineMapping());
    }
}
