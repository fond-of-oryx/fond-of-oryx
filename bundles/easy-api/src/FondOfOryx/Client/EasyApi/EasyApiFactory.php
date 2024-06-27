<?php

namespace FondOfOryx\Client\EasyApi;

use FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface;
use FondOfOryx\Client\EasyApi\Zed\EasyApiZedStub;
use FondOfOryx\Client\EasyApi\Zed\EasyApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class EasyApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): EasyApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(EasyApiDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \FondOfOryx\Client\EasyApi\Zed\EasyApiZedStubInterface
     */
    public function createEasyApiZedStub(): EasyApiZedStubInterface
    {
        return new EasyApiZedStub(
            $this->getZedRequestClient(),
        );
    }
}
