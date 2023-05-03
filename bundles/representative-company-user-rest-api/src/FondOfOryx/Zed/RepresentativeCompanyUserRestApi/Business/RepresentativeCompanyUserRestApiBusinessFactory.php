<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business;

use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepositoryInterface getRepository()
 */
class RepresentativeCompanyUserRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface
     */
    public function createRepresentationManager(): RepresentationManagerInterface
    {
        return new RepresentationManager(
            $this->getRepresentativeCompanyUserFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
     */
    protected function getRepresentativeCompanyUserFacade(): RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER);
    }
}
