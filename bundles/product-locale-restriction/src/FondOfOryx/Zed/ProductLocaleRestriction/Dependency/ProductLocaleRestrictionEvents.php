<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Dependency;

interface ProductLocaleRestrictionEvents
{
    /**
     * @var string
     */
    public const PRODUCT_ABSTRACT_LOCALE_RESTRICTION_PUBLISH = 'ProductLocaleRestriction.product_abstract_locale_restriction.publish';

    /**
     * @var string
     */
    public const PRODUCT_ABSTRACT_LOCALE_RESTRICTION_UNPUBLISH = 'ProductLocaleRestriction.product_abstract_locale_restriction.unpublish';

    /**
     * @var string
     */
    public const ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_CREATE = 'Entity.foo_product_abstract_locale_restriction.create';

    /**
     * @var string
     */
    public const ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_UPDATE = 'Entity.foo_product_abstract_locale_restriction.update';

    /**
     * @var string
     */
    public const ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_DELETE = 'Entity.foo_product_abstract_locale_restriction.delete';
}
