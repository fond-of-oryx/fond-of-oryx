<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi;

use Codeception\Test\Unit;

class RepresentativeCompanyUserTradeFairRestApiConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig
     */
    protected RepresentativeCompanyUserTradeFairRestApiConfig $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->config = new RepresentativeCompanyUserTradeFairRestApiConfig();
    }

    /**
     * @return void
     */
    public function testGetMaxDurationForRepresentation(): void
    {
        static::assertEquals(7, $this->config->getMaxDurationForRepresentation());
    }
}
