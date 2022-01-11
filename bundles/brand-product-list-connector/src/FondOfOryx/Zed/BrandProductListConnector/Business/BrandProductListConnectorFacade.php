<?php

namespace FondOfOryx\Zed\BrandProductListConnector\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\BrandProductListConnector\Persistence\BrandProductListConnectorRepositoryInterface getRepository()
 */
class BrandProductListConnectorFacade extends AbstractFacade implements BrandProductListConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $brandIds
     *
     * @return array<int>
     */
    public function getBrandIdsByProductListIds(array $brandIds): array
    {
        return $this->getRepository()->getBrandIdsByProductListIds($brandIds);
    }
}
