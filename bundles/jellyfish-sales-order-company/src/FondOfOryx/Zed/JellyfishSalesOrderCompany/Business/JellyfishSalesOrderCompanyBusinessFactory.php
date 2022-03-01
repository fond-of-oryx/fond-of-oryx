<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business;

use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander\JellyfishOrderExpander;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReader;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReaderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\JellyfishSalesOrderCompanyDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class JellyfishSalesOrderCompanyBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander\JellyfishOrderExpanderInterface
     */
    public function createJellyfishOrderExpander(): JellyfishOrderExpanderInterface
    {
        return new JellyfishOrderExpander(
            $this->createLocaleReader(),
            $this->getCompanyUserReferenceFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReaderInterface
     */
    protected function createLocaleReader(): LocaleReaderInterface
    {
        return new LocaleReader(
            $this->getLocaleFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface
     */
    protected function getCompanyUserReferenceFacade(): JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface
    {
        return $this->getProvidedDependency(
            JellyfishSalesOrderCompanyDependencyProvider::FACADE_COMPANY_USER_REFERENCE,
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeInterface
     */
    protected function getLocaleFacade(): JellyfishSalesOrderCompanyToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderCompanyDependencyProvider::FACADE_LOCALE);
    }
}
