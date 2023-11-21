<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapper;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidator;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig getConfig()
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface getRepository()
 */
class RepresentativeCompanyUserTradeFairRestApiBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface
     */
    public function createTradeFairRepresentationManager(): TradeFairRepresentationManagerInterface
    {
        return new TradeFairRepresentationManager(
            $this->getRepresentativeCompanyUserTradeFairFacade(),
            $this->getCompanyTypeFacade(),
            $this->createDurationValidator(),
            $this->getRepository(),
            $this->createRestDataMapper(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface
     */
    public function createDurationValidator(): DurationValidatorInterface
    {
        return new DurationValidator($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapperInterface
     */
    public function createRestDataMapper(): RestDataMapperInterface
    {
        return new RestDataMapper();
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected function getRepresentativeCompanyUserTradeFairFacade(): RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
     */
    protected function getCompanyTypeFacade(): RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairRestApiDependencyProvider::FACADE_COMPANY_TYPE);
    }
}
