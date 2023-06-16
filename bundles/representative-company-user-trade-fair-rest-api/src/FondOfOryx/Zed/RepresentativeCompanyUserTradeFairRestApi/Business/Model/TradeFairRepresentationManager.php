<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model;

use Exception;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Communication\Plugin\PermissionExtension\CanManageRepresentationOnTradeFairPermissionPlugin;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;

class TradeFairRepresentationManager implements TradeFairRepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
     */
    protected $companyTypeFacade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface
     */
    protected $durationValidator;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected $representativeCompanyUserTradeFairFacade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $companyTypeFacade
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface $durationValidator
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade,
        RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $companyTypeFacade,
        DurationValidatorInterface $durationValidator,
        RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository
    ) {
        $this->representativeCompanyUserTradeFairFacade = $representativeCompanyUserTradeFairFacade;
        $this->companyTypeFacade = $companyTypeFacade;
        $this->durationValidator = $durationValidator;
        $this->repository = $repository;
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
            ->setIsSuccessful(false)
            ->setRequest($restRepresentativeCompanyUserTradeFairRequestTransfer);

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
            ->setRequest($restRepresentativeCompanyUserTradeFairRequestTransfer)
            ->setRepresentation($response);
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
            ->setRequest($restRepresentativeCompanyUserTradeFairRequestTransfer)
            ->setRepresentation($response);
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
        } catch (Exception $exception) {
            //ToDo Handle/Log
            $representation = null;
        }

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())->setRepresentation($representation);
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
        $filter = (new RepresentativeCompanyUserTradeFairFilterTransfer());

        if ($attributes->getUuid() !== null) {
            $filter->addUuid($attributes->getUuid());
        }

        $collection = $this->representativeCompanyUserTradeFairFacade->getRepresentativeCompanyUserTradeFair($filter);

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())->setCollection($collection);
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
}
