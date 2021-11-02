<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business;

use FondOfOryx\Zed\CreditMemoApi\Business\Mapper\TransferMapper;
use FondOfOryx\Zed\CreditMemoApi\Business\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\CreditMemoApi\Business\Model\CreditMemoApi;
use FondOfOryx\Zed\CreditMemoApi\Business\Model\CreditMemoApiInterface;
use FondOfOryx\Zed\CreditMemoApi\Business\Model\Validator\CreditMemoApiValidator;
use FondOfOryx\Zed\CreditMemoApi\Business\Model\Validator\CreditMemoApiValidatorInterface;
use FondOfOryx\Zed\CreditMemoApi\CreditMemoApiDependencyProvider;
use FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToCreditMemoFacadeInterface;
use FondOfOryx\Zed\CreditMemoApi\Dependency\QueryContainer\CreditMemoApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CreditMemoApi\CreditMemoApiConfig getConfig()
 */
class CreditMemoApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CreditMemoApi\Business\Model\CreditMemoApiInterface
     */
    public function createCreditMemoApi(): CreditMemoApiInterface
    {
        return new CreditMemoApi(
            $this->getApiQueryContainer(),
            $this->createTransferMapper(),
            $this->getCreditMemoFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoApi\Business\Mapper\TransferMapperInterface
     */
    protected function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoApi\Business\Model\Validator\CreditMemoApiValidatorInterface
     */
    public function createCreditMemoApiValidator(): CreditMemoApiValidatorInterface
    {
        return new CreditMemoApiValidator();
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoApi\Dependency\QueryContainer\CreditMemoApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CreditMemoApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CreditMemoApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToCreditMemoFacadeInterface
     */
    protected function getCreditMemoFacade(): CreditMemoApiToCreditMemoFacadeInterface
    {
        return $this->getProvidedDependency(CreditMemoApiDependencyProvider::FACADE_CREDIT_MEMO);
    }
}
