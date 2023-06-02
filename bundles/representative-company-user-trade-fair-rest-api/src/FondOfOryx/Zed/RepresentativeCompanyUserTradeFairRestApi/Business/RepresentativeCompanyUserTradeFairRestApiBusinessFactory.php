<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface getRepository()
 */
class RepresentativeCompanyUserTradeFairRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface
     */
    public function createTradeFairRepresentationManager(): TradeFairRepresentationManagerInterface
    {
        return new TradeFairRepresentationManager(
            $this->getRepresentativeCompanyUserTradeFairFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected function getRepresentativeCompanyUserTradeFairFacade(): RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER);
    }
}
