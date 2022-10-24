<?php

namespace FondOfOryx\Glue\ProductListsRestApi;

class ProductListsRestApiConfig
{
 /**
  * @var string
  */
    public const RESOURCE_PRODUCT_LISTS = 'product-lists';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_PRODUCT_LISTS = 'product-lists-resource';

    /**
     * @var string
     */
    public const RESPONSE_CODE_PRODUCT_LIST_ID_IS_MISSING = '9002';

    /**
     * @var string
     */
    public const RESPONSE_DETAIL_PRODUCT_LIST_ID_IS_MISSING = 'Product list id is missing.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_PRODUCT_LIST_COULD_NOT_BE_UPDATED = '9001';

    /**
     * @var string
     */
    public const RESPONSE_DETAIL_PRODUCT_LIST_COULD_NOT_BE_UPDATED = 'Product list could not be updated';
}
