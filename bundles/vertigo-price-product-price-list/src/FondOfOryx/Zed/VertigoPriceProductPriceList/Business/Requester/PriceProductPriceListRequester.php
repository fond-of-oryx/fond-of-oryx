<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester;

use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Exception\SkuNotExistsException;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface;
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
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @param \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface $vertigoPriceApiAdapter
     * @param \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface $repository
     * @param \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface $productFacade
     */
    public function __construct(
        VertigoPriceApiAdapterInterface $vertigoPriceApiAdapter,
        VertigoPriceProductPriceListRepositoryInterface $repository,
        VertigoPriceProductPriceListToProductFacadeInterface $productFacade
    ) {
        $this->vertigoPriceApiAdapter = $vertigoPriceApiAdapter;
        $this->repository = $repository;
        $this->productFacade = $productFacade;
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

    /**
     * @param string $sku
     *
     * @throws \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Exception\SkuNotExistsException
     *
     * @return void
     */
    public function requestBySku(string $sku): void
    {
        if (!$this->productFacade->hasProductConcrete($sku)) {
            throw new SkuNotExistsException(sprintf('SKU "%s" does not exist.', $sku));
        }

        $vertigoPriceApiRequestTransfer = (new VertigoPriceApiRequestTransfer())
            ->setBody(['skus' => [$sku]]);

        $this->vertigoPriceApiAdapter->sendRequest($vertigoPriceApiRequestTransfer);
    }
}
