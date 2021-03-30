<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader\CompanyUnitAddressReader;
use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface
     */
    public function createCompanyUnitAddressReader(): ReturnLabelsRestApiRepositoryInterface
    {
        return new CompanyUnitAddressReader($this->getRepository());
    }
}
