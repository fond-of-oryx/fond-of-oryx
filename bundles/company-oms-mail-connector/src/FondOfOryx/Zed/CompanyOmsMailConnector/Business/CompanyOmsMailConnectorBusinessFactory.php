<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business;

use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\ExpanderInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\LocaleExpander;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\MailExpander;
use FondOfOryx\Zed\CompanyOmsMailConnector\CompanyOmsMailConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompanyOmsMailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\ExpanderInterface
     */
    public function createLocaleExpander(): ExpanderInterface
    {
        return new LocaleExpander(
            $this->getCompanyUserReferenceFacade(),
            $this->getLocaleFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\ExpanderInterface
     */
    public function createMailExpander(): ExpanderInterface
    {
        return new MailExpander($this->getCompanyUserReferenceFacade());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface
     */
    protected function getLocaleFacade(): CompanyOmsMailConnectorToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyOmsMailConnectorDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface
     */
    protected function getCompanyUserReferenceFacade(): CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface
    {
        return $this->getProvidedDependency(CompanyOmsMailConnectorDependencyProvider::FACADE_COMPANY_USER_REFERENCE);
    }
}
