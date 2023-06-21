<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager;

use ArrayObject;
use FondOfOryx\Shared\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConstants;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataEnrichmentPluginExecutionerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;

class BulkManager implements BulkManagerInterface
{
    protected PermissionCheckerInterface $permissionChecker;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface
     */
    protected CompanyUsersBulkRestApiToEventFacadeInterface $eventFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataEnrichmentPluginExecutionerInterface
     */
    protected BulkDataEnrichmentPluginExecutionerInterface $enrichmentPluginExecutioner;

    /**
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface $permissionChecker
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface $eventFacade
     */
    public function __construct(
        PermissionCheckerInterface                    $permissionChecker,
        CompanyUsersBulkRestApiToEventFacadeInterface $eventFacade,
        BulkDataEnrichmentPluginExecutionerInterface  $enrichmentPluginExecutioner
    )
    {
        $this->permissionChecker = $permissionChecker;
        $this->eventFacade = $eventFacade;
        $this->enrichmentPluginExecutioner = $enrichmentPluginExecutioner;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    public function handleBulkRequest(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkResponseTransfer
    {
//        if (!$this->permissionChecker->check($restCompanyUsersBulkRequestTransfer)) {
//            return $this->createEmptyResponseTransfer()
//                ->setCode(CompanyUsersBulkRestApiConstants::ERROR_CODE_PERMISSION_DENIED)
//                ->setError(CompanyUsersBulkRestApiConstants::ERROR_MESSAGE_MISSING_PERMISSION);
//        }

        $attributes = $restCompanyUsersBulkRequestTransfer->getAttributes();

        if ($attributes !== null && count($attributes->getAssign()) > 0) {
            $this->eventFacade->trigger(CompanyUsersBulkRestApiConstants::BULK_ASSIGN, $this->createCollectionTransfer($attributes->getAssign()));
        }

        if ($attributes !== null && count($attributes->getUnassign()) > 0) {
            $this->eventFacade->trigger(CompanyUsersBulkRestApiConstants::BULK_UNASSIGN, $this->createCollectionTransfer($attributes->getUnassign()));
        }
        return $this->createEmptyResponseTransfer();
    }

    public function createCompanyUser(RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer): void
    {
        // TODO: Implement createCompanyUser() method.
    }

    public function deleteCompanyUser(RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer): void
    {
        // TODO: Implement deleteCompanyUser() method.
    }

    protected function prepareData(RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer)
    {
        $companyCache = [];
        $customerCache = [];
        foreach ($restCompanyUsersBulkItemCollectionTransfer->getItems() as $item) {
            $companyUsersBulkPreparationTransfer = (new CompanyUsersBulkPreparationTransfer())
                ->setCompanyCache($companyCache)
                ->setCustomerCache($customerCache)
                ->setItem($item);

            $companyUsersBulkPreparationTransfer = $this->enrichmentPluginExecutioner->executePrePlugins($companyUsersBulkPreparationTransfer);
            $companyUsersBulkPreparationTransfer = $this->enrichmentPluginExecutioner->executePostPlugins($companyUsersBulkPreparationTransfer);

            $companyCache = $companyUsersBulkPreparationTransfer->getCompanyCache();
            $customerCache = $companyUsersBulkPreparationTransfer->getCustomerCache();

            $item = $companyUsersBulkPreparationTransfer->getItem();
            $companyUser = $this->createDummyCompanyUserTransfer();
            //ToDo
        }


    }

    /**
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    protected function createEmptyResponseTransfer(): RestCompanyUsersBulkResponseTransfer
    {
        return new RestCompanyUsersBulkResponseTransfer();
    }

    /**
     * @param \ArrayObject $arrayObject
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer
     */
    protected function createCollectionTransfer(ArrayObject $arrayObject): RestCompanyUsersBulkItemCollectionTransfer
    {
        return (new RestCompanyUsersBulkItemCollectionTransfer())->setItems($arrayObject);
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function createDummyCompanyUserTransfer(): CompanyUserTransfer
    {
        return (new CompanyUserTransfer())->setIsActive(true)->setIsDefault(false);
    }
}
