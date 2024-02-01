<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model;

use DateTime;
use FondOfOryx\Shared\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConstants;
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
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserPaginationTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use Psr\Log\LoggerInterface;
use Throwable;

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
     * @var \Psr\Log\LoggerInterface
     */
    protected LoggerInterface $logger;

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
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade,
        RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $companyTypeFacade,
        DurationValidatorInterface $durationValidator,
        RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository,
        RestDataMapperInterface $restDataMapper,
        LoggerInterface $logger
    ) {
        $this->representativeCompanyUserTradeFairFacade = $representativeCompanyUserTradeFairFacade;
        $this->companyTypeFacade = $companyTypeFacade;
        $this->durationValidator = $durationValidator;
        $this->repository = $repository;
        $this->restDataMapper = $restDataMapper;
        $this->logger = $logger;
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

        if ($error !== null) {
            return $restRepresentativeCompanyUserTradeFairResponse->setError($error);
        }

        try {
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
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage(), $throwable->getTrace());

            return $restRepresentativeCompanyUserTradeFairResponse->setError($this->createError(RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_MESSAGE_ADD_ERROR, RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_ADD_ERRORS));
        }

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
        $restResponse = (new RestRepresentativeCompanyUserTradeFairResponseTransfer())->setIsSuccessful(false);

        $error = $this->validate($restRepresentativeCompanyUserTradeFairRequestTransfer);

        if ($error !== null) {
            return $restResponse->setError($error);
        }

        try {
            $representationTransfer = $this->representativeCompanyUserTradeFairFacade->findTradeFairRepresentationByUuid($restRepresentativeCompanyUserTradeFairAttributesTransfer->getUuid());

            if (
                $representationTransfer->getDistributor()->getCustomerReference() !== $restRepresentativeCompanyUserTradeFairAttributesTransfer->getCustomerReferenceRepresentative()
            ) {
                $representationTransfer->setActive(false);
                $this->representativeCompanyUserTradeFairFacade->updateRepresentativeCompanyUserTradeFair($representationTransfer);

                return $this->addTradeFairRepresentation($restRepresentativeCompanyUserTradeFairRequestTransfer);
            }

            $representationTransfer
                ->setName($restRepresentativeCompanyUserTradeFairAttributesTransfer->getTradeFairName())
                ->setActive($this->getStatus($representationTransfer, $restRepresentativeCompanyUserTradeFairAttributesTransfer))
                ->setEndAt($restRepresentativeCompanyUserTradeFairAttributesTransfer->getEndAt())
                ->setStartAt($restRepresentativeCompanyUserTradeFairAttributesTransfer->getStartAt());
            $response = $this->representativeCompanyUserTradeFairFacade->updateRepresentativeCompanyUserTradeFair($representationTransfer);
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage(), $throwable->getTrace());

            return $restResponse->setError($this->createError(RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_MESSAGE_UPDATE_ERROR, RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_UPDATE_ERRORS));
        }

        return $restResponse
            ->setRepresentation($this->restDataMapper->mapResponse($response))->setIsSuccessful(true);
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
        $restResponse = (new RestRepresentativeCompanyUserTradeFairResponseTransfer())->setIsSuccessful(false);

        try {
            $attributes->requireUuid();
            $representation = $this->representativeCompanyUserTradeFairFacade->deleteRepresentativeCompanyUserTradeFair($attributes->getUuid());
            $response = $this->restDataMapper->mapResponse($representation);
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage(), $throwable->getTrace());

            return $restResponse->setError($this->createError(RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_MESSAGE_DELETE_ERROR, RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_DELETE_ERRORS));
        }

        return $restResponse->setRepresentation($response)->setIsSuccessful(true);
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
        $today = (new DateTime())->setTime(0, 0);
        $startAt = new DateTime($representativeCompanyUserTradeFairAttributesTransfer->getStartAt());

        if ($startAt < $today) {
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
        $pagination = $this->createPagination($collection);
        $collectionTransfer = $this->restDataMapper->mapResponseCollection($collection);
        $collectionTransfer->setPagination($pagination);

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())
            ->setCollection($collectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorMessageTransfer|null
     */
    protected function validate(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
    ): ?RestErrorMessageTransfer {
        $companyTypeManufacturer = $this->companyTypeFacade->getCompanyTypeManufacturer();

        if (
            !$companyTypeManufacturer
            || !$this->repository->hasPermission(
                CanManageRepresentationOnTradeFairPermissionPlugin::KEY,
                $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getCustomerReferenceOriginator(),
                $companyTypeManufacturer->getIdCompanyType(),
            )
        ) {
            return $this->createError(RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION, (string)RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS, RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS);
        }

        if (
            !$this->durationValidator->validate($restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes())
        ) {
            return $this->createError(RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_REPRESENTATION_DURATION_EXCEEDED, (string)RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS, RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS);
        }

        return null;
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributes
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer
     */
    public function createFilter(
        RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransfer,
        RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributes
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
            $filter->setRepresentative($attributes->getCustomerReferenceOriginator());
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

    /**
     * @param string $message
     * @param string $code
     * @param int $status
     *
     * @return \Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    protected function createError(string $message, string $code, int $status = 400): RestErrorMessageTransfer
    {
        return (new RestErrorMessageTransfer())
            ->setDetail($message)
            ->setCode($code)
            ->setStatus($status);
    }
}
