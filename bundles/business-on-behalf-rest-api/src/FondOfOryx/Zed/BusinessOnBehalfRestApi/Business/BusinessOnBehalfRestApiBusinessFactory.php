<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business;

use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReader;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriter;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriterInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiDependencyProvider;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface getRepository()
 */
class BusinessOnBehalfRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriterInterface
     */
    public function createCompanyUserWriter(): CompanyUserWriterInterface
    {
        return new CompanyUserWriter(
            $this->createCompanyUserReader(),
            $this->getBusinessOnBehalfFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->getCompanyUserFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface
     */
    protected function getCompanyUserFacade(): BusinessOnBehalfRestApiToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(BusinessOnBehalfRestApiDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface
     */
    protected function getBusinessOnBehalfFacade(): BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface
    {
        return $this->getProvidedDependency(BusinessOnBehalfRestApiDependencyProvider::FACADE_BUSINESS_ON_BEHALF);
    }
}
