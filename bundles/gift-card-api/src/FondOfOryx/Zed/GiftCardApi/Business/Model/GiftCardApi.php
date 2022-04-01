<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model;

use FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class GiftCardApi implements GiftCardApiInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepositoryInterface $repository
     */
    public function __construct(GiftCardApiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->repository->findByApiRequest($apiRequestTransfer);
    }
}
