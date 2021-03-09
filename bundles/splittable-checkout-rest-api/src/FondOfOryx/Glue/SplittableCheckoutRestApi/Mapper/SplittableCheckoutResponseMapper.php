<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper;

use Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutResponseTransfer;

class SplittableCheckoutResponseMapper implements SplittableCheckoutResponseMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CheckoutRestApiExtension\Dependency\Plugin\CheckoutResponseMapperPluginInterface[]
     */
    protected $splittableCheckoutResponseMapperPlugins;

    /**
     * @param \Spryker\Glue\CheckoutRestApiExtension\Dependency\Plugin\CheckoutResponseMapperPluginInterface[] $checkoutResponseMapperPlugins
     */
    public function __construct(array $checkoutResponseMapperPlugins)
    {
        $this->checkoutResponseMapperPlugins = $checkoutResponseMapperPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutResponseTransfer $restCheckoutResponseTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer $restCheckoutResponseAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer
     */
    public function mapRestCheckoutResponseTransferToRestCheckoutResponseAttributesTransfer(
        RestCheckoutResponseTransfer $restCheckoutResponseTransfer,
        RestCheckoutResponseAttributesTransfer $restCheckoutResponseAttributesTransfer
    ): RestCheckoutResponseAttributesTransfer {
        $restCheckoutResponseAttributesTransfer->fromArray($restCheckoutResponseTransfer->toArray(), true);

        return $this->executeCheckoutResponseMapperPlugins(
            $restCheckoutResponseTransfer,
            $restCheckoutResponseAttributesTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutResponseTransfer $restCheckoutResponseTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer $restCheckoutResponseAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer
     */
    protected function executeCheckoutResponseMapperPlugins(
        RestCheckoutResponseTransfer $restCheckoutResponseTransfer,
        RestCheckoutResponseAttributesTransfer $restCheckoutResponseAttributesTransfer
    ): RestCheckoutResponseAttributesTransfer {
        foreach ($this->checkoutResponseMapperPlugins as $checkoutResponseMapperPlugin) {
            $restCheckoutResponseAttributesTransfer = $checkoutResponseMapperPlugin
                ->mapRestCheckoutResponseTransferToRestCheckoutResponseAttributesTransfer(
                    $restCheckoutResponseTransfer,
                    $restCheckoutResponseAttributesTransfer
                );
        }

        return $restCheckoutResponseAttributesTransfer;
    }
}
