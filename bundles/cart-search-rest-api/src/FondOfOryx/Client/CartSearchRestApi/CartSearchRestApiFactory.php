<?php

namespace FondOfOryx\Client\CartSearchRestApi;

use FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CartSearchRestApi\Zed\CartSearchRestApiStub;
use FondOfOryx\Client\CartSearchRestApi\Zed\CartSearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CartSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CartSearchRestApi\Zed\CartSearchRestApiStubInterface
     */
    public function createZedCartSearchRestApiStub(): CartSearchRestApiStubInterface
    {
        return new CartSearchRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CartSearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CartSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
