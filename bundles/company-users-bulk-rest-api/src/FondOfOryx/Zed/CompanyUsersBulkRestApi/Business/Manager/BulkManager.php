<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager;

use ArrayObject;
use Exception;
use FondOfOryx\Shared\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConstants;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataPluginExecutionerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;
use Psr\Log\LoggerInterface;
use Throwable;

class BulkManager implements BulkManagerInterface
{
    protected PermissionCheckerInterface $permissionChecker;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface
     */
    protected CompanyUsersBulkRestApiToEventFacadeInterface $eventFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeInterface
     */
    protected CompanyUsersBulkRestApiToCompanyUserFacadeInterface $companyUserFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataPluginExecutionerInterface
     */
    protected BulkDataPluginExecutionerInterface $pluginExecutioner;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface
     */
    protected CompanyUsersBulkRestApiRepositoryInterface $repository;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface $permissionChecker
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface $eventFacade
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeInterface $companyUserFacade
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\PluginExecutioner\BulkDataPluginExecutionerInterface $pluginExecutioner
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface $repository
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        PermissionCheckerInterface                          $permissionChecker,
        CompanyUsersBulkRestApiToEventFacadeInterface       $eventFacade,
        CompanyUsersBulkRestApiToCompanyUserFacadeInterface $companyUserFacade,
        BulkDataPluginExecutionerInterface                  $pluginExecutioner,
        CompanyUsersBulkRestApiRepositoryInterface          $repository,
        LoggerInterface                                     $logger
    )
    {
        $this->permissionChecker = $permissionChecker;
        $this->eventFacade = $eventFacade;
        $this->companyUserFacade = $companyUserFacade;
        $this->pluginExecutioner = $pluginExecutioner;
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    public function handleBulkRequest(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkResponseTransfer
    {
        try {
            $restCompanyUsersBulkRequestTransfer = $this->pluginExecutioner->executePreHandlePlugins($restCompanyUsersBulkRequestTransfer);

//            if (!$this->permissionChecker->check($restCompanyUsersBulkRequestTransfer)) {
//                return $this->pluginExecutioner->executePostHandlePlugins($this->createEmptyResponseTransfer()
//                    ->setCode(CompanyUsersBulkRestApiConstants::ERROR_CODE_PERMISSION_DENIED)
//                    ->setError(CompanyUsersBulkRestApiConstants::ERROR_MESSAGE_MISSING_PERMISSION)
//                    ->setRequest($restCompanyUsersBulkRequestTransfer)
//                );
//            }

            $attributes = $restCompanyUsersBulkRequestTransfer->getAttributes();

            if ($attributes !== null && count($attributes->getAssign()) > 0) {
                $this->eventFacade->trigger(CompanyUsersBulkRestApiConstants::BULK_ASSIGN, $this->createCollectionTransfer($attributes->getAssign()));
            }

            if ($attributes !== null && count($attributes->getUnassign()) > 0) {
                $this->eventFacade->trigger(CompanyUsersBulkRestApiConstants::BULK_UNASSIGN, $this->createCollectionTransfer($attributes->getUnassign()));
            }
        } catch (Throwable $throwable) {
            return $this->pluginExecutioner->executePostHandlePlugins(
                $this->createEmptyResponseTransfer()
                    ->setCode(CompanyUsersBulkRestApiConstants::ERROR_CODE)
                    ->setIsSuccessful(false)
                    ->setError($throwable->getMessage())
            );
        }

        return $this->pluginExecutioner->executePostHandlePlugins(
            $this->createEmptyResponseTransfer()
                ->setCode(CompanyUsersBulkRestApiConstants::SUCCESS_CODE)
                ->setIsSuccessful(true)
        );
    }

    public function createCompanyUser(RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer): void
    {
        $prepareDataCollection = $this->prepareData($restCompanyUsersBulkItemCollectionTransfer);

        foreach ($prepareDataCollection as $prepareData) {
            $company = $prepareData->getCompany();
            $customer = $prepareData->getCustomer();
            $role = $this->resolveRole($prepareData);
            foreach ($company->getCompanyBusinessUnits() as $companyBusinessUnit) {
                $companyUserTransfer = $this->createDummyCompanyUserTransfer()
                    ->setCustomerReference($customer->getCustomerReference())
                    ->setFkCustomer($customer->getIdCustomer())
                    ->setCustomer($customer)
                    ->setCompanyRole($role)
                    ->setFkCompany($company->getIdCompany())
                    ->setFkCompanyBusinessUnit($companyBusinessUnit->getIdCompanyBusinessUnit())
                    ->setCompany($company);


                if ($this->repository->findCompanyUser($companyUserTransfer) !== null) {
                    continue;
                }

                $response = $this->companyUserFacade->create($companyUserTransfer);

                if (!$response->getIsSuccessful()) {
                    //ToDo handle error case
                }
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer
     * @return void
     */
    public function deleteCompanyUser(RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer): void
    {
        $prepareDataCollection = $this->prepareData($restCompanyUsersBulkItemCollectionTransfer);

        foreach ($prepareDataCollection as $prepareData) {
            $company = $prepareData->getCompany();
            $customer = $prepareData->getCustomer();

            $companyUserCollectionTransfer = $this->repository->findCompanyUsersByFkCompanyAndFkCustomer($company->getIdCompany(), $customer->getIdCustomer());
            foreach ($companyUserCollectionTransfer->getCompanyUsers() as $companyUserTransfer) {

                if ($companyUserTransfer->getCompanyRole()->getName() !== $prepareData->getItem()->getRole()){
                    continue;
                }

                $response = $this->companyUserFacade->deleteCompanyUser($companyUserTransfer);

                if (!$response->getIsSuccessful()) {
                    //ToDo handle error case
                }
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer
     * @return \ArrayObject|CompanyUsersBulkPreparationTransfer[]
     */
    protected function prepareData(RestCompanyUsersBulkItemCollectionTransfer $restCompanyUsersBulkItemCollectionTransfer): ArrayObject
    {
        $collection = new ArrayObject();
        $companyCache = [];
        $customerCache = [];
        foreach ($restCompanyUsersBulkItemCollectionTransfer->getItems() as $item) {
            $companyUsersBulkPreparationTransfer = (new CompanyUsersBulkPreparationTransfer())
                ->setCompanyCache($companyCache)
                ->setCustomerCache($customerCache)
                ->setItem($item);

            $companyUsersBulkPreparationTransfer = $this->pluginExecutioner->executePreEnrichmentPlugins($companyUsersBulkPreparationTransfer);
            $companyUsersBulkPreparationTransfer = $this->pluginExecutioner->executePostEnrichmentPlugins($companyUsersBulkPreparationTransfer);

            $companyCache = $companyUsersBulkPreparationTransfer->getCompanyCache();
            $customerCache = $companyUsersBulkPreparationTransfer->getCustomerCache();

            $collection->append($companyUsersBulkPreparationTransfer);
        }

        return $collection;
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

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     * @throws \Exception
     */
    protected function resolveRole(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyRoleTransfer
    {
        $roles = $companyUsersBulkPreparationTransfer->getCompany()->getCompanyRoles();
        foreach ($companyUsersBulkPreparationTransfer->getCompany()->getCompanyRoles() as $companyRole) {
            if ($companyUsersBulkPreparationTransfer->getItem()->getRole() === $companyRole->getName()) {
                return $companyRole;
            }
        }
        throw new Exception(sprintf('Role with given name "%s" not found!', $companyUsersBulkPreparationTransfer->getItem()->getRole()));
    }
}
