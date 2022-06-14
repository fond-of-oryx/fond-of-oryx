<?php

namespace FondOfOryx\Zed\ProductListApi\Business;

use FondOfOryx\Zed\ProductListApi\Business\Model\ProductListApi;
use FondOfOryx\Zed\ProductListApi\Business\Model\ProductListApiInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductListApi\ProductListApiConfig getConfig()
 * @method \FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface getRepository()
 */
class ProductListApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductListApi\Business\Model\ProductListApiInterface
     */
    public function createProductListApi(): ProductListApiInterface
    {
        return new ProductListApi($this->getRepository());
    }
}
