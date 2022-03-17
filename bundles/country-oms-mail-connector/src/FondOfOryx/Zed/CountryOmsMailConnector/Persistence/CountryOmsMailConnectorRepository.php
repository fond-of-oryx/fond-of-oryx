<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Persistence;

use Generated\Shared\Transfer\CountryTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorPersistenceFactory getFactory()
 */
class CountryOmsMailConnectorRepository extends AbstractRepository implements CountryOmsMailConnectorRepositoryInterface
{
    /**
     * @param int $idCountry
     *
     * @return \Generated\Shared\Transfer\CountryTransfer|null
     */
    public function getCountryByIdCountry(int $idCountry): ?CountryTransfer
    {
        $country = $this->getFactory()
            ->getCountryQuery()
            ->clear()
            ->findOneByIdCountry($idCountry);

        if ($country === null) {
            return null;
        }

        return $this->getFactory()
            ->createCountryMapper()
            ->mapEntityToTransfer($country);
    }
}
