<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager\TradeFairRepresentationManager;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager\TradeFairRepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service\RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\RepresentativeCompanyUserTradeFairDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManagerInterface getEntityManager()
 */
class RepresentativeCompanyUserTradeFairBusinessFactory extends AbstractBusinessFactory
{
    use TransactionTrait;
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager\TradeFairRepresentationManagerInterface
     */
    public function createTradeFairRepresentationManager(): TradeFairRepresentationManagerInterface
    {
        return new TradeFairRepresentationManager(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getRepresentativeCompanyUserFacade(),
            $this->getUtilUuidGeneratorService(),
            $this->getTransactionHandler(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service\RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface
     */
    protected function getUtilUuidGeneratorService(): RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairDependencyProvider::SERVICE_UTIL_UUID_GENERATOR);
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface
     */
    protected function getRepresentativeCompanyUserFacade(): RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER);
    }
}
