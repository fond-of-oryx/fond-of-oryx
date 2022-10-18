<?php

namespace FondOfOryx\Client\ProductListsRestApi;

use FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use FondOfOryx\Client\ProductListsRestApi\Zed\ProductListsRestApiStub;
use FondOfOryx\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductListsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface
     */
    public function createProductListsRestApiStub(): ProductListsRestApiStubInterface
    {
        return new ProductListsRestApiStub(
            $this->getZedRequestClient(),
        );
    }

    /**
     * @return \FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): ProductListsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ProductListsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
