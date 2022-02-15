<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business;

use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model\ErpDeliveryNoteApi;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model\ErpDeliveryNoteApiInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator\ErpDeliveryNoteApiValidator;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator\ErpDeliveryNoteApiValidatorInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig getConfig()
 */
class ErpDeliveryNoteApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model\ErpDeliveryNoteApiInterface
     */
    public function createErpDeliveryNoteApi(): ErpDeliveryNoteApiInterface
    {
        return new ErpDeliveryNoteApi(
            $this->getApiQueryContainer(),
            $this->getErpDeliveryNoteFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): ErpDeliveryNoteApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNoteApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface
     */
    protected function getErpDeliveryNoteFacade(): ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNoteApiDependencyProvider::FACADE_ERP_DELIVERY_NOTE);
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator\ErpDeliveryNoteApiValidatorInterface
     */
    public function createErpDeliveryNoteApiValidator(): ErpDeliveryNoteApiValidatorInterface
    {
        return new ErpDeliveryNoteApiValidator();
    }
}
