<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;

class SplittableCheckoutRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_QUOTE = 'FACADE_QUOTE';
    public const FACADE_SPLITTABLE_CHECKOUT = 'FACADE_SPLITTABLE_CHECKOUT';

    public const PLUGINS_QUOTE_EXPANDER = 'PLUGINS_QUOTE_EXPANDER';
}
