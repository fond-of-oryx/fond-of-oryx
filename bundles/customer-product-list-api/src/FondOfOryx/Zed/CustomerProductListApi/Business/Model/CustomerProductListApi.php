<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business\Model;

use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerProductListApi implements CustomerProductListApiInterface
{
    /**
     * @var string
     */
    public const DATA_KEY_FK_CUSTOMER = 'fk_customer';

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface
     */
    protected $customerProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface $customerProductListConnectorFacade
     * @param \FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerInterface $apiQueryContainer
     */
    public function __construct(
        CustomerProductListApiToCustomerProductListConnectorFacadeInterface $customerProductListConnectorFacade,
        CustomerProductListApiToApiQueryContainerInterface $apiQueryContainer
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->customerProductListConnectorFacade = $customerProductListConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = (array)$apiDataTransfer->getData();

        $customerProductListRelationTransfer = new CustomerProductListRelationTransfer();
        $customerProductListRelationTransfer->fromArray($data, true);
        $customerProductListRelationTransfer->setIdCustomer($data[static::DATA_KEY_FK_CUSTOMER]);

        $this->customerProductListConnectorFacade
            ->persistCustomerProductListRelation($customerProductListRelationTransfer);

        return $this->apiQueryContainer->createApiItem($customerProductListRelationTransfer);
    }
}
