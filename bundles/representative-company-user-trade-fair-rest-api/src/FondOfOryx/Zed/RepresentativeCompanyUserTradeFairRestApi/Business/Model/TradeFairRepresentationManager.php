<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model;

use Exception;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Communication\Plugin\PermissionExtension\CanManageRepresentationOnTradeFairPermissionPlugin;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterSortTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserPaginationTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;

class TradeFairRepresentationManager implements TradeFairRepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
     */
    protected RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $companyTypeFacade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface
     */
    protected DurationValidatorInterface $durationValidator;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface
     */
    protected RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapperInterface
     */
    protected RestDataMapperInterface $restDataMapper;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $companyTypeFacade
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface $durationValidator
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapperInterface $restDataMapper
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade,
        RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $companyTypeFacade,
        DurationValidatorInterface $durationValidator,
        RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository,
        RestDataMapperInterface $restDataMapper
    ) {
        $this->representativeCompanyUserTradeFairFacade = $representativeCompanyUserTradeFairFacade;
        $this->companyTypeFacade = $companyTypeFacade;
        $this->durationValidator = $durationValidator;
        $this->repository = $repository;
        $this->restDataMapper = $restDataMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function addTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        $restRepresentativeCompanyUserTradeFairResponse = (new RestRepresentativeCompanyUserTradeFairResponseTransfer())
            ->setIsSuccessful(false);

        $error = $this->validate($restRepresentativeCompanyUserTradeFairRequestTransfer);

        if ($error) {
            return $restRepresentativeCompanyUserTradeFairResponse->setError($error);
        }

        $restRepresentativeCompanyUserTradeFairAttributesTransfer = $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes();
        $originatorId = $this->repository->getIdCustomerByReference($restRepresentativeCompanyUserTradeFairAttributesTransfer->getCustomerReferenceOriginator());
        $representationId = $this->repository->getIdCustomerByReference($restRepresentativeCompanyUserTradeFairAttributesTransfer->getCustomerReferenceRepresentative());

        $representationTransfer = (new RepresentativeCompanyUserTradeFairTransfer())
            ->setFkDistributor($representationId)
            ->setFkOriginator($originatorId)
            ->setName($restRepresentativeCompanyUserTradeFairAttributesTransfer->getTradeFairName())
            ->setStartAt($restRepresentativeCompanyUserTradeFairAttributesTransfer->getStartAt())
            ->setEndAt($restRepresentativeCompanyUserTradeFairAttributesTransfer->getEndAt());

        $response = $this->representativeCompanyUserTradeFairFacade->addRepresentativeCompanyUserTradeFair($representationTransfer);

        return $restRepresentativeCompanyUserTradeFairResponse
            ->setIsSuccessful(true)
            ->setRepresentation($this->restDataMapper->mapResponse($response));
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function updateTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        $restRepresentativeCompanyUserTradeFairAttributesTransfer = $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes();
        $restRepresentativeCompanyUserTradeFairAttributesTransfer->requireUuid();

        $error = $this->validate($restRepresentativeCompanyUserTradeFairRequestTransfer);

        if ($error) {
            return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())->setError($error);
        }

        $representationTransfer = $this->representativeCompanyUserTradeFairFacade->findTradeFairRepresentationByUuid($restRepresentativeCompanyUserTradeFairAttributesTransfer->getUuid());

        if (
            $representationTransfer->getDistributor()->getCustomerReference() !== $restRepresentativeCompanyUserTradeFairAttributesTransfer->getCustomerReferenceRepresentative()
        ) {
            $representationTransfer->setActive(false);
            $this->representativeCompanyUserTradeFairFacade->updateRepresentativeCompanyUserTradeFair($representationTransfer);

            return $this->addTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
        }

        $representationTransfer
            ->setActive($this->getStatus($representationTransfer, $restRepresentativeCompanyUserTradeFairAttributesTransfer))
            ->setEndAt($restRepresentativeCompanyUserTradeFairAttributesTransfer->getEndAt())
            ->setStartAt($restRepresentativeCompanyUserTradeFairAttributesTransfer->getStartAt());
        $response = $this->representativeCompanyUserTradeFairFacade->updateRepresentativeCompanyUserTradeFair($representationTransfer);

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())
            ->setRepresentation($this->restDataMapper->mapResponse($response));
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function deleteTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        $attributes = $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes();

        try {
            $attributes->requireUuid();
            $representation = $this->representativeCompanyUserTradeFairFacade->deleteRepresentativeCompanyUserTradeFair($attributes->getUuid());
            $response = $this->restDataMapper->mapResponse($representation);
        } catch (Exception $exception) {
            //ToDo Handle/Log
            $response = null;
        }

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())->setRepresentation($response);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer $representativeCompanyUserTradeFairAttributesTransfer
     *
     * @return bool
     */
    protected function getStatus(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer,
        RestRepresentativeCompanyUserTradeFairAttributesTransfer $representativeCompanyUserTradeFairAttributesTransfer
    ): bool {
        if ($representativeCompanyUserTradeFairAttributesTransfer->getStartAt() < $representativeCompanyUserTradeFairTransfer->getStartAt()) {
            return false;
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    public function getTradeFairRepresentation(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): RestRepresentativeCompanyUserTradeFairResponseTransfer {
        $attributes = $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes();
        $filter = $this->createFilter($restRepresentativeCompanyUserTradeFairRequestTransfer, $attributes);

        $collection = $this->representativeCompanyUserTradeFairFacade->getRepresentativeCompanyUserTradeFair($filter);

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())
            ->setCollection($this->restDataMapper->mapResponseCollection($collection))
            ->setPagination($this->createPagination($collection));
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return string
     */
    protected function validate(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): string {
        $companyTypeManufacturer = $this->companyTypeFacade->getCompanyTypeManufacturer();

        if (
            !$companyTypeManufacturer
            || !$this->repository->hasPermission(
                CanManageRepresentationOnTradeFairPermissionPlugin::KEY,
                $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getCustomerReferenceOriginator(),
                $companyTypeManufacturer->getIdCompanyType(),
            )
        ) {
            return RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION;
        }

        if (
            !$this->durationValidator->validate($restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes())
        ) {
            return RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_REPRESENTATION_DURATION_EXCEEDED;
        }

        return '';
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer|null $attributes
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer
     */
    public function createFilter(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer,
        ?RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributes
    ): RepresentativeCompanyUserTradeFairFilterTransfer {
        $restFilter = $restRepresentativeCompanyUserTradeFairRequestTransfer->getFilter();
        $filter = new RepresentativeCompanyUserTradeFairFilterTransfer();

        if ($restFilter !== null) {
            $filter->fromArray($restRepresentativeCompanyUserTradeFairRequestTransfer->getFilter()->toArray(), true);

            $page = $restFilter->getPage();
            if ($page !== null) {
                $filter
                    ->setLimit($page->getLimit())
                    ->setOffset($page->getOffset());
            }

            $sorting = $restFilter->getSort();
            if ($sorting->count() > 0) {
                foreach ($sorting as $sort) {
                    $filter->addSort((new RepresentativeCompanyUserFilterSortTransfer())->fromArray($sort->toArray(), true));
                }
            }
        }

        if ($attributes->getUuid() !== null) {
            $filter = $filter->addUuid($attributes->getUuid());
        }

        return $filter;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer $collection
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserPaginationTransfer
     */
    public function createPagination(RepresentativeCompanyUserTradeFairCollectionTransfer $collection): RestRepresentativeCompanyUserPaginationTransfer
    {
        $paginationTransfer = new RestRepresentativeCompanyUserPaginationTransfer();
        $pagination = $collection->getPagination();
        $total = $pagination->getTotal();
        $limit = $pagination->getLimit();
        $offset = $pagination->getOffset();

        if ($limit !== null & $total !== null && $limit > 0) {
            $paginationTransfer->setMaxPage((int)ceil($total / $limit));
        }

        if ($limit !== null & $offset !== null && $limit > 0) {
            $current = ceil($offset / $limit);
            $paginationTransfer->setCurrentPage($current > 0 ? $current : 1);
        }

        return $paginationTransfer
            ->setNumFound($total)
            ->setCurrentItemsPerPage($limit);
    }
}
