<?php

namespace FondOfOryx\Service\CrossEngage\Model\Resolver;

interface ResolverInterface
{
    /**
     * @throws \Spryker\Shared\Kernel\Locale\LocaleNotFoundException
     *
     * @return string
     */
    public function resolve(): string;
}
