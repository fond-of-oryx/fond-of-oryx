<?php

namespace FondOfOryx\Client\AvailabilityAlert;

use FondOfOryx\Client\AvailabilityAlert\Zed\AvailabilityAlertStub;
use Spryker\Client\Kernel\AbstractFactory;

class AvailabilityAlertFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\AvailabilityAlert\Zed\AvailabilityAlertStubInterface
     */
    public function createAvailabilityAlertStub()
    {
        return new AvailabilityAlertStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(AvailabilityAlertDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
