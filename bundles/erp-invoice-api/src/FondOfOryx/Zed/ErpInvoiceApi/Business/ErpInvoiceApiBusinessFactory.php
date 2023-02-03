<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business;

use FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApi;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApiInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidator;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidatorInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiConfig getConfig()
 */
class ErpInvoiceApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApiInterface
     */
    public function createErpInvoiceApi(): ErpInvoiceApiInterface
    {
        return new ErpInvoiceApi(
            $this->getApiFacade(),
            $this->getErpInvoiceFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToApiFacadeInterface
     */
    protected function getApiFacade(): ErpInvoiceApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(ErpInvoiceApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface
     */
    protected function getErpInvoiceFacade(): ErpInvoiceApiToErpInvoiceFacadeInterface
    {
        return $this->getProvidedDependency(ErpInvoiceApiDependencyProvider::FACADE_ERP_INVOICE);
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidatorInterface
     */
    public function createErpInvoiceApiValidator(): ErpInvoiceApiValidatorInterface
    {
        return new ErpInvoiceApiValidator();
    }
}
