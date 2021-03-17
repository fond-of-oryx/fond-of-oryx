<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade;

use Generated\Shared\Transfer\CountryTransfer;
use Spryker\Zed\Country\Business\CountryFacadeInterface;

class ShipmentTableRateToCountryFacadeBridge implements ShipmentTableRateToCountryFacadeInterface
{
    /**
     * @var \Spryker\Zed\Country\Business\CountryFacadeInterface
     */
    protected $countryFacade;

    /**
     * @param \Spryker\Zed\Country\Business\CountryFacadeInterface $countryFacade
     */
    public function __construct(CountryFacadeInterface $countryFacade)
    {
        $this->countryFacade = $countryFacade;
    }

    /**
     * @param string $iso2Code
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function getCountryByIso2Code(string $iso2Code): CountryTransfer
    {
        return $this->countryFacade->getCountryByIso2Code($iso2Code);
    }
}
