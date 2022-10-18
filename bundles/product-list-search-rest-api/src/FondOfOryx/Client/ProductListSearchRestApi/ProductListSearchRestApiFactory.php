<?php

namespace FondOfOryx\Client\ProductListSearchRestApi;

use FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\ProductListSearchRestApi\Zed\ProductListSearchRestApiStub;
use FondOfOryx\Client\ProductListSearchRestApi\Zed\ProductListSearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductListSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ProductListSearchRestApi\Zed\ProductListSearchRestApiStubInterface
     */
    public function createZedProductListSearchRestApiStub(): ProductListSearchRestApiStubInterface
    {
        return new ProductListSearchRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): ProductListSearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ProductListSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
