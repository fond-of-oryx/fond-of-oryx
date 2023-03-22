<?php

namespace FondOfOryx\Zed\ErpOrder\Dependency\Facade;

use FondOfSpryker\Zed\Country\Business\CountryFacadeInterface;
use Generated\Shared\Transfer\CountryTransfer;

class ErpOrderToCountryFacadeBridge implements ErpOrderToCountryFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\Country\Business\CountryFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfSpryker\Zed\Country\Business\CountryFacadeInterface $facade
     */
    public function __construct(CountryFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param int $idCountry
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function getCountryByIdCountry(int $idCountry): CountryTransfer
    {
        return $this->facade->getCountryByIdCountry($idCountry);
    }
}
