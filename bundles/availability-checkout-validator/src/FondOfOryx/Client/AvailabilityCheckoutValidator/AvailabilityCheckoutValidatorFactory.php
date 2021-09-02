<?php

namespace FondOfOryx\Client\AvailabilityCheckoutValidator;

use FondOfOryx\Client\AvailabilityCheckoutValidator\Dependency\Client\AvailabilityCheckoutValidatorToZedRequestClientInterface;
use FondOfOryx\Client\AvailabilityCheckoutValidator\Zed\AvailabilityCheckoutValidatorStub;
use FondOfOryx\Client\AvailabilityCheckoutValidator\Zed\AvailabilityCheckoutValidatorStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class AvailabilityCheckoutValidatorFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\AvailabilityCheckoutValidator\Zed\AvailabilityCheckoutValidatorStubInterface
     */
    public function createAvailabilityCheckoutValidatorZedStub(): AvailabilityCheckoutValidatorStubInterface
    {
        return new AvailabilityCheckoutValidatorStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\AvailabilityCheckoutValidator\Dependency\Client\AvailabilityCheckoutValidatorToZedRequestClientInterface
     */
    public function getZedRequestClient(): AvailabilityCheckoutValidatorToZedRequestClientInterface
    {
        return $this->getProvidedDependency(AvailabilityCheckoutValidatorDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
