<?php

namespace FondOfOryx\Glue\CartsRestApiAttributesConnector\Plugin;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use Spryker\Glue\CartsRestApiExtension\Dependency\Plugin\RestCartItemsAttributesMapperPluginInterface;

class ModelDataRestCartItemsAttributesMapperPlugin implements RestCartItemsAttributesMapperPluginInterface
{
    /**
     * @var string
     */
    protected const IDENTIFIER = 'model';

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Generated\Shared\Transfer\RestItemsAttributesTransfer $restItemsAttributesTransfer
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\RestItemsAttributesTransfer
     */
    public function mapItemTransferToRestItemsAttributesTransfer(
        ItemTransfer $itemTransfer,
        RestItemsAttributesTransfer $restItemsAttributesTransfer,
        string $localeName
    ): RestItemsAttributesTransfer {
        foreach ($itemTransfer->getConcreteAttributes() as $key => $attribute) {
            if ($key === static::IDENTIFIER) {
                $restItemsAttributesTransfer->setModel($attribute);
            }
        }

        return $restItemsAttributesTransfer;
    }
}
