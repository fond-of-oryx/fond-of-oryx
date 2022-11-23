<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;

interface CustomerRegistrationToLocaleQueryContainerInterface
{
    /**
     * @param string $localeString
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery
     */
    public function queryLocaleByName(string $localeString): SpyLocaleQuery;
}
