<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence;

use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Tax\Persistence\Map\SpyTaxRateTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class ProductTaxCalculatorRepository extends AbstractRepository implements TaxCalculationConnectorRepositoryInterface
{
    protected const COL_MAX_TAX_RATE = 'MaxTaxRate';
    protected const COL_ID_ABSTRACT_PRODUCT = 'IdProductAbstract';
    protected const COL_COUNTRY_CODE = 'COUNTRY_CODE';
    protected const TAX_EXEMPT_PLACEHOLDER = 'Tax Exempt';
    /**
     * @api
     *
     * @param int[] $idProductAbstracts
     * @param string[] $countryIso2Code
     * @param int[] $idRegions
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(array $idProductAbstracts, array $countryIso2Code, array $idRegions): TaxCalculationConnectorTransfer
    {
        $taxRateEntity = $this->getFactory()
            ->createTaxSetQuery()
            ->useSpyProductAbstractQuery()
                ->filterByIdProductAbstract($idProductAbstracts, Criteria::IN)
                ->withColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, static::COL_ID_ABSTRACT_PRODUCT)
                ->groupBy(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)
            ->endUse()
            ->useSpyTaxSetTaxQuery()
                ->useSpyTaxRateQuery()
                    ->useCountryQuery()
                        ->filterByIso2Code($countryIso2Code, Criteria::IN)
                        ->withColumn(SpyCountryTableMap::COL_ISO2_CODE, static::COL_COUNTRY_CODE)
                        ->groupBy(SpyCountryTableMap::COL_ISO2_CODE)
                    ->endUse()
                    ->_and()
                    ->useSpyRegionQuery()->filterByIdRegion($idRegions, Criteria::IN)->endUse()
                    ->_or()
                ->filterByFkCountry(null)
                ->endUse()
                ->withColumn('MAX(' . SpyTaxRateTableMap::COL_RATE . ')', static::COL_MAX_TAX_RATE)
            ->endUse()
            ->select([static::COL_COUNTRY_CODE, static::COL_MAX_TAX_RATE, SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT])
            ->find();

        return $this->factory()->getTaxSetMapper()->mapTaxRate($taxRateEntity);
    }

    /**
     * @param array $idProductAbstracts
     * @param array $countryIso2Code
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function getTaxSetByIdProductAbstractAndCountryIso2Codes(array $idProductAbstracts, array $countryIso2Code): TaxCalculationConnectorTransfer
    {
        $taxRateEntity = $this->factory()
            ->getProductTaxQueryContainer()
            ->queryTaxSetByIdProductAbstractAndCountryIso2Codes($idProductAbstracts, $countryIso2Code);

        return $this->factory()->getTaxSetMapper()->mapTaxRate($taxRateEntity);
    }
}
