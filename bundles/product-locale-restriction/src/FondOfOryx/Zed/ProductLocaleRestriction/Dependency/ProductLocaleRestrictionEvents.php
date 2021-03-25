<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Dependency;

interface ProductLocaleRestrictionEvents
{
    public const PRODUCT_ABSTRACT_LOCALE_RESTRICTION_PUBLISH = 'ProductLocaleRestriction.product_abstract_locale_restriction.publish';
    public const PRODUCT_ABSTRACT_LOCALE_RESTRICTION_UNPUBLISH = 'ProductLocaleRestriction.product_abstract_locale_restriction.unpublish';

    public const ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_CREATE = 'Entity.foo_product_abstract_locale_restriction.create';
    public const ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_UPDATE = 'Entity.foo_product_abstract_locale_restriction.update';
    public const ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_DELETE = 'Entity.foo_product_abstract_locale_restriction.delete';
}
