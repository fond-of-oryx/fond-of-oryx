<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model;

use Exception;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\Map\FooRepresentativeCompanyUserTradeFairTableMap;

class TradeFairRepresentationManager implements TradeFairRepresentationManagerInterface
{
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
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacade,
        RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repository
    ) {
        $this->representativeCompanyUserTradeFairFacade = $representativeCompanyUserTradeFairFacade;
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

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())
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
     * @return string
     */
    protected function getStatus(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer,
        RestRepresentativeCompanyUserTradeFairAttributesTransfer $representativeCompanyUserTradeFairAttributesTransfer
    ): string {
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

        if ($attributes->getUuid() !== null){
            $filter->addUuid($attributes->getUuid());
        }

        $collection = $this->representativeCompanyUserTradeFairFacade->getRepresentativeCompanyUserTradeFair($filter);

        return (new RestRepresentativeCompanyUserTradeFairResponseTransfer())->setCollection($collection);
    }
}
