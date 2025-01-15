<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence;

use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;
use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Tax\Persistence\Map\SpyTaxRateTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorPersistenceFactory getFactory()
 */
class TaxCalculationConnectorRepository extends AbstractRepository implements TaxCalculationConnectorRepositoryInterface
{
    /**
     * @param array<int> $idProductAbstracts
     * @param array<string> $countryIso2Code
     * @param array<int> $idRegions
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(
        array $idProductAbstracts,
        array $countryIso2Code,
        array $idRegions
    ): TaxCalculationConnectorTransfer {
        /** @var \Propel\Runtime\Collection\ArrayCollection|iterable $taxRateEntity */
        $taxRateEntity = $this->getFactory()//@phpstan-ignore-line
            ->createTaxSetQuery()
            ->useSpyProductAbstractQuery()
                ->filterByIdProductAbstract($idProductAbstracts, Criteria::IN)
                ->withColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, TaxCalculationConnectorConstants::COL_ID_ABSTRACT_PRODUCT)
                ->groupBy(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)
                ->endUse()
            ->useSpyTaxSetTaxQuery()
                ->useSpyTaxRateQuery()
                    ->useCountryQuery()
                        ->filterByIso2Code($countryIso2Code, Criteria::IN)
                        ->withColumn(SpyCountryTableMap::COL_ISO2_CODE, TaxCalculationConnectorConstants::COL_COUNTRY_CODE)
                        ->groupBy(SpyCountryTableMap::COL_ISO2_CODE)
                    ->endUse()
                    ->_and()
                    ->useSpyRegionQuery()->filterByIdRegion($idRegions, Criteria::IN)->endUse()
                    ->_or()
                    ->filterByFkCountry(null)
                ->endUse()
                ->withColumn('MAX(' . SpyTaxRateTableMap::COL_RATE . ')', TaxCalculationConnectorConstants::COL_MAX_TAX_RATE)
            ->endUse()
            ->select([TaxCalculationConnectorConstants::COL_COUNTRY_CODE, TaxCalculationConnectorConstants::COL_MAX_TAX_RATE, SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT])
            ->find();

        return $this->getFactory()->getTaxRateMapper()->mapTaxRate($taxRateEntity);
    }

    /**
     * @param array<int> $idProductAbstracts
     * @param array<string> $countryIso2Code
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function getTaxSetByIdProductAbstractAndCountryIso2Codes(array $idProductAbstracts, array $countryIso2Code): TaxCalculationConnectorTransfer
    {
        /** @var \Propel\Runtime\Collection\ArrayCollection|iterable $taxRateEntity */
        $taxRateEntity = $this->getFactory()
            ->getProductTaxQueryContainer()
            ->queryTaxSetByIdProductAbstractAndCountryIso2Codes($idProductAbstracts, $countryIso2Code);

        return $this->getFactory()->getTaxRateMapper()->mapTaxRate($taxRateEntity);
    }
}
