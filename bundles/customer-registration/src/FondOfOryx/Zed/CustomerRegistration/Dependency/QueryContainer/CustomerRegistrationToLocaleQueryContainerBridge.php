<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface;

class CustomerRegistrationToLocaleQueryContainerBridge implements CustomerRegistrationToLocaleQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface $localeQueryContainer
     */
    public function __construct(LocaleQueryContainerInterface $localeQueryContainer)
    {
        $this->queryContainer = $localeQueryContainer;
    }

    /**
     * @param string $localeString
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery
     */
    public function queryLocaleByName(string $localeString): SpyLocaleQuery
    {
        return $this->queryContainer->queryLocaleByName($localeString);
    }
}
