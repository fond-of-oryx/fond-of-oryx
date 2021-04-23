<?php

namespace FondOfOryx\Service\CrossEngage\Model\Resolver;

use Spryker\Shared\Kernel\Store;

class LanguagePrefixResolver implements ResolverInterface
{
    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $store;

    /**
     * @param \Spryker\Shared\Kernel\Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * @return string
     */
    public function resolve(): string
    {
        $language = array_search($this->store->getCurrentLocale(), $this->store->getLocales());
        if ($language !== false) {
            return $language;
        }

        return $this->store->getCurrentLanguage();
    }
}
