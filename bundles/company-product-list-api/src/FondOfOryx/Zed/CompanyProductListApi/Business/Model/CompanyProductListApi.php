<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business\Model;

use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListApi implements CompanyProductListApiInterface
{
    /**
     * @var string
     */
    public const DATA_KEY_FK_CUSTOMER = 'fk_company';

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface
     */
    protected $companyProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface $companyProductListConnectorFacade
     * @param \FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToApiFacadeInterface $apiFacade
     */
    public function __construct(
        CompanyProductListApiToCompanyProductListConnectorFacadeInterface $companyProductListConnectorFacade,
        CompanyProductListApiToApiFacadeInterface $apiFacade
    ) {
        $this->apiFacade = $apiFacade;
        $this->companyProductListConnectorFacade = $companyProductListConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = (array)$apiDataTransfer->getData();

        $companyProductListRelationTransfer = new CompanyProductListRelationTransfer();
        $companyProductListRelationTransfer->fromArray($data, true);
        $companyProductListRelationTransfer->setIdCompany($data[static::DATA_KEY_FK_CUSTOMER]);

        $this->companyProductListConnectorFacade
            ->persistCompanyProductListRelation($companyProductListRelationTransfer);

        return $this->apiFacade->createApiItem($companyProductListRelationTransfer);
    }
}
