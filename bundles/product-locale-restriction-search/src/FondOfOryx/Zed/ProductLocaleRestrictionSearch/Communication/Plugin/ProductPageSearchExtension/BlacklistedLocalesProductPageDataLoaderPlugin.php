<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearchExtension;

use Generated\Shared\Transfer\ProductPageLoadTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductPageDataLoaderPluginInterface;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\ProductLocaleRestrictionSearchCommunicationFactory getFactory()
 */
class BlacklistedLocalesProductPageDataLoaderPlugin extends AbstractPlugin implements ProductPageDataLoaderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductPageLoadTransfer $productPageLoadTransfer
     *
     * @return \Generated\Shared\Transfer\ProductPageLoadTransfer
     */
    public function expandProductPageDataTransfer(ProductPageLoadTransfer $productPageLoadTransfer): ProductPageLoadTransfer
    {
        $blacklistedLocaleIds = $this->getFactory()
            ->getProductLocaleRestrictionFacade()
            ->getBlacklistedLocalesByProductAbstractIds($productPageLoadTransfer->getProductAbstractIds());

        $this->updatePayloadTransfers($productPageLoadTransfer->getPayloadTransfers(), $blacklistedLocaleIds);

        return $productPageLoadTransfer;
    }

    /**
     * @param array<\Generated\Shared\Transfer\ProductPayloadTransfer> $payloadTransfers
     * @param array $blacklistedLocaleIds
     *
     * @return array<\Generated\Shared\Transfer\ProductPayloadTransfer>
     */
    protected function updatePayloadTransfers(array $payloadTransfers, array $blacklistedLocaleIds): array
    {
        foreach ($payloadTransfers as $payloadTransfer) {
            $idProductAbstract = $payloadTransfer->getIdProductAbstract();

            if (!isset($blacklistedLocaleIds[$idProductAbstract])) {
                continue;
            }

            $payloadTransfer->setBlacklistedLocales($blacklistedLocaleIds[$idProductAbstract]);
        }

        return $payloadTransfers;
    }
}
