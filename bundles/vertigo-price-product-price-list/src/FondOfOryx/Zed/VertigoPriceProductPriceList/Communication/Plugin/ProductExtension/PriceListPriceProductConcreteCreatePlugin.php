<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Plugin\ProductExtension;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductExtension\Dependency\Plugin\ProductConcreteCreatePluginInterface;

/**
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacadeInterface getFacade()
 */
class PriceListPriceProductConcreteCreatePlugin extends AbstractPlugin implements ProductConcreteCreatePluginInterface
{
     /**
      * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
      *
      * @return \Generated\Shared\Transfer\ProductConcreteTransfer
      */
    public function create(ProductConcreteTransfer $productConcreteTransfer): ProductConcreteTransfer
    {
        $this->getFacade()->requestMissingPriceProductPriceListByProductConcrete($productConcreteTransfer);

        return $productConcreteTransfer;
    }
}
