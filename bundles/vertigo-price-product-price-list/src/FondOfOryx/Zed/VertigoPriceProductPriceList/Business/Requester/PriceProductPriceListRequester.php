<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester;

use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface;
use Generated\Shared\Transfer\VertigoPriceApiRequestTransfer;

class PriceProductPriceListRequester implements PriceProductPriceListRequesterInterface
{
    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface
     */
    protected $vertigoPriceApiAdapter;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface $vertigoPriceApiAdapter
     * @param \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface $repository
     */
    public function __construct(
        VertigoPriceApiAdapterInterface $vertigoPriceApiAdapter,
        VertigoPriceProductPriceListRepositoryInterface $repository
    ) {
        $this->vertigoPriceApiAdapter = $vertigoPriceApiAdapter;
        $this->repository = $repository;
    }

    /**
     * @return void
     */
    public function requestAllMissing(): void
    {
        $skus = $this->repository->getSkusWithoutPriceProductPriceList();

        if (count($skus) === 0) {
            return;
        }

        $vertigoPriceApiRequestTransfer = (new VertigoPriceApiRequestTransfer())
            ->setBody(['skus' => $skus]);

        $this->vertigoPriceApiAdapter->sendRequest($vertigoPriceApiRequestTransfer);
    }
}
