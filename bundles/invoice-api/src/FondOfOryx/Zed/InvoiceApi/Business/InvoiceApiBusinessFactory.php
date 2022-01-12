<?php

namespace FondOfOryx\Zed\InvoiceApi\Business;

use FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapper;
use FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\InvoiceApi\Business\Model\InvoiceApi;
use FondOfOryx\Zed\InvoiceApi\Business\Model\InvoiceApiInterface;
use FondOfOryx\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidator;
use FondOfOryx\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidatorInterface;
use FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface;
use FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerInterface;
use FondOfOryx\Zed\InvoiceApi\InvoiceApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\InvoiceApi\InvoiceApiConfig getConfig()
 */
class InvoiceApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\InvoiceApi\Business\Model\InvoiceApiInterface
     */
    public function createInvoiceApi(): InvoiceApiInterface
    {
        return new InvoiceApi(
            $this->getApiQueryContainer(),
            $this->createTransferMapper(),
            $this->getInvoiceFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface
     */
    protected function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfOryx\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidatorInterface
     */
    public function createInvoiceApiValidator(): InvoiceApiValidatorInterface
    {
        return new InvoiceApiValidator();
    }

    /**
     * @return \FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): InvoiceApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(InvoiceApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface
     */
    protected function getInvoiceFacade(): InvoiceApiToInvoiceFacadeInterface
    {
        return $this->getProvidedDependency(InvoiceApiDependencyProvider::FACADE_CREDIT_MEMO);
    }
}
