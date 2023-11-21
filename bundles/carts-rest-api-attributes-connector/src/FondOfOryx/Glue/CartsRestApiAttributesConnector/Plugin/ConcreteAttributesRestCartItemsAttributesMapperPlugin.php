<?php

namespace FondOfOryx\Glue\CartsRestApiAttributesConnector\Plugin;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use Spryker\Glue\CartsRestApiExtension\Dependency\Plugin\RestCartItemsAttributesMapperPluginInterface;

class ConcreteAttributesRestCartItemsAttributesMapperPlugin implements RestCartItemsAttributesMapperPluginInterface
{
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
        return $restItemsAttributesTransfer->setProductConcreteAttributes($this->convertArrayKeysToCamelCase($itemTransfer->getConcreteAttributes()));
    }

    /**
     * @param array<string, string> $array
     *
     * @return array<string, string>
     */
    protected function convertArrayKeysToCamelCase(array $array): array
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            $newArray[$this->stringToCamelCase($key)] = $value;
        }

        return $newArray;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    protected function stringToCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }
}
