<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business;

use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapper;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepositoryInterface getRepository()
 */
class RepresentativeCompanyUserRestApiBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface
     */
    public function createRepresentationManager(): RepresentationManagerInterface
    {
        return new RepresentationManager(
            $this->getRepresentativeCompanyUserFacade(),
            $this->getRepository(),
            $this->createRestDataMapper(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapperInterface
     */
    public function createRestDataMapper(): RestDataMapperInterface
    {
        return new RestDataMapper();
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
     */
    protected function getRepresentativeCompanyUserFacade(): RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER);
    }
}
