<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model;

use Exception;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepositoryInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterSortTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserPaginationTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;

class RepresentationManager implements RepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
     */
    protected RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface $representativeCompanyUserFacade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepositoryInterface
     */
    protected RepresentativeCompanyUserRestApiRepositoryInterface $repository;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapperInterface
     */
    protected RestDataMapperInterface $restDataMapper;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface $representativeCompanyUserFacade
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepositoryInterface $repository
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapperInterface $restDataMapper
     */
    public function __construct(
        RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface $representativeCompanyUserFacade,
        RepresentativeCompanyUserRestApiRepositoryInterface $repository,
        RestDataMapperInterface $restDataMapper
    ) {
        $this->representativeCompanyUserFacade = $representativeCompanyUserFacade;
        $this->repository = $repository;
        $this->restDataMapper = $restDataMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function addRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        $restRepresentativeCompanyUserAttributesTransfer = $restRepresentativeCompanyUserRequestTransfer->getAttributes();
        $distributorId = $this->repository->getIdCustomerByReference($restRepresentativeCompanyUserAttributesTransfer->getReferenceDistributor());
        $representationId = $this->repository->getIdCustomerByReference($restRepresentativeCompanyUserAttributesTransfer->getReferenceRepresentation());
        $originatorId = $distributorId;
        if ($restRepresentativeCompanyUserAttributesTransfer->getReferenceDistributor() !== $restRepresentativeCompanyUserAttributesTransfer->getReferenceOriginator()) {
            $originatorId = $this->repository->getIdCustomerByReference($restRepresentativeCompanyUserAttributesTransfer->getReferenceOriginator());
        }

        $representationTransfer = (new RepresentativeCompanyUserTransfer())
            ->setFkDistributor($distributorId)
            ->setFkOriginator($originatorId)
            ->setFkRepresentative($representationId)
            ->setStartAt($restRepresentativeCompanyUserAttributesTransfer->getStartAt())
            ->setEndAt($restRepresentativeCompanyUserAttributesTransfer->getEndAt());

        $response = $this->representativeCompanyUserFacade->addRepresentativeCompanyUser($representationTransfer);

        return (new RestRepresentativeCompanyUserResponseTransfer())
            ->setRequest($restRepresentativeCompanyUserRequestTransfer)
            ->addRepresentation($this->restDataMapper->mapResponse($response));
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function updateRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        $restRepresentativeCompanyUserAttributesTransfer = $restRepresentativeCompanyUserRequestTransfer->getAttributes();
        $restRepresentativeCompanyUserAttributesTransfer->requireUuid();

        $representationTransfer = $this->representativeCompanyUserFacade->findRepresentationByUuid($restRepresentativeCompanyUserAttributesTransfer->getUuid());

        if (
            $representationTransfer->getDistributor()->getCustomerReference() !== $restRepresentativeCompanyUserAttributesTransfer->getReferenceDistributor()
            || $representationTransfer->getRepresentative()->getCustomerReference() !== $restRepresentativeCompanyUserAttributesTransfer->getReferenceRepresentation()
        ) {
            $representationTransfer->setState(FooRepresentativeCompanyUserTableMap::COL_STATE_REVOKED);
            $this->representativeCompanyUserFacade->updateRepresentativeCompanyUser($representationTransfer);

            return $this->addRepresentation($restRepresentativeCompanyUserRequestTransfer);
        }

        $representationTransfer
            ->setState($this->getState($representationTransfer, $restRepresentativeCompanyUserAttributesTransfer))
            ->setEndAt($restRepresentativeCompanyUserAttributesTransfer->getEndAt())
            ->setStartAt($restRepresentativeCompanyUserAttributesTransfer->getStartAt());
        $response = $this->representativeCompanyUserFacade->updateRepresentativeCompanyUser($representationTransfer);

        return (new RestRepresentativeCompanyUserResponseTransfer())
            ->setRequest($restRepresentativeCompanyUserRequestTransfer)
            ->addRepresentation($this->restDataMapper->mapResponse($response));
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function deleteRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        $attributes = $restRepresentativeCompanyUserRequestTransfer->getAttributes();

        try {
            $attributes->requireUuid();
            $representation = $this->representativeCompanyUserFacade->deleteRepresentativeCompanyUser($attributes->getUuid());
        } catch (Exception $exception) {
            //ToDo Handle/Log
            $representation = null;
        }

        return (new RestRepresentativeCompanyUserResponseTransfer())->addRepresentation($this->restDataMapper->mapResponse($representation));
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer $representativeCompanyUserAttributesTransfer
     *
     * @return string
     */
    protected function getState(
        RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer,
        RestRepresentativeCompanyUserAttributesTransfer $representativeCompanyUserAttributesTransfer
    ): string {
        if ($representativeCompanyUserAttributesTransfer->getStartAt() < $representativeCompanyUserTransfer->getStartAt()) {
            return FooRepresentativeCompanyUserTableMap::COL_STATE_REVOKED;
        }

        return FooRepresentativeCompanyUserTableMap::COL_STATE_ACTIVE;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    public function getRepresentation(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
    ): RestRepresentativeCompanyUserResponseTransfer {
        $attributes = $restRepresentativeCompanyUserRequestTransfer->getAttributes();
        $filter = $this->createFilter($restRepresentativeCompanyUserRequestTransfer, $attributes);

        $collection = $this->representativeCompanyUserFacade->getRepresentativeCompanyUser($filter);

        return (new RestRepresentativeCompanyUserResponseTransfer())
            ->setRepresentations($this->restDataMapper->mapResponseCollection($collection))
            ->setPagination($this->createPagination($collection));
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer|null $attributes
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer
     */
    public function createFilter(
        RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransfer,
        ?RestRepresentativeCompanyUserAttributesTransfer $attributes
    ): RepresentativeCompanyUserFilterTransfer {
        $restFilter = $restRepresentativeCompanyUserRequestTransfer->getFilter();
        $filter = new RepresentativeCompanyUserFilterTransfer();

        if ($restFilter !== null) {
            $filter->fromArray($restRepresentativeCompanyUserRequestTransfer->getFilter()->toArray(), true);

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

            $representative = $restFilter->getRepresentative();
            if ($representative !== null) {
                $filter->addDistributorReference($representative);
            }
        }

        if ($attributes->getUuid() !== null) {
            $filter = $filter->addId($attributes->getUuid());
        }

        return $filter;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $collection
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserPaginationTransfer
     */
    public function createPagination(RepresentativeCompanyUserCollectionTransfer $collection): RestRepresentativeCompanyUserPaginationTransfer
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
