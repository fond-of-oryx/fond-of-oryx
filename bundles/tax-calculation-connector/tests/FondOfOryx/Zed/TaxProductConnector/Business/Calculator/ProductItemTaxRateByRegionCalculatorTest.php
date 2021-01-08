<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\ProductTaxCalculatorQueryContainer;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Propel\Runtime\Collection\ArrayCollection;
use Spryker\Zed\ProductTaxCalculator\Dependency\Facade\ProductTaxCalculatorToTaxInterface;
use \Orm\Zed\Tax\Persistence\SpyTaxSetQuery;

class ProductItemTaxRateByRegionCalculatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductTaxCalculator\Dependency\Facade\ProductTaxCalculatorToTaxInterface
     */
    private $taxFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockBuilder|\FondOfOryx\Zed\TaxCalculationConnector\Persistence\ProductTaxCalculatorQueryContainer
     */
    private $queryContainerMock;

    /**
     * @var \Orm\Zed\Tax\Persistence\SpyTaxSetQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    private $taxSetQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->taxFacadeMock = $this->getMockBuilder(ProductTaxCalculatorToTaxInterface::class)
            ->getMock();


        $this->queryContainerMock = $this->getMockBuilder(ProductTaxCalculatorQueryContainer::class)
            ->onlyMethods([
                'queryTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions',
                'queryTaxSetByIdProductAbstractAndCountryIso2Codes'
            ])
            ->disableOriginalConstructor()
            ->getMock();

        $this->taxSetQueryMock = $this->getMockBuilder(SpyTaxSetQuery::class)
            ->onlyMethods(['find'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testRecalculateWithCalculableObjectWithoutRegion(): void
    {
        $country = 'DE';
        $idProductAbstract = 1;
        $this->taxSetQueryMock
            ->method('find')
            ->willReturn($this->getTaxObject($country, $idProductAbstract));
        $this->queryContainerMock
            ->method('queryTaxSetByIdProductAbstractAndCountryIso2Codes')
            ->with([$idProductAbstract], [$country])
            ->willReturn($this->taxSetQueryMock);

        $calculableObject = new CalculableObjectTransfer();
        $item = new ItemTransfer();
        $item->setIdProductAbstract($idProductAbstract);
        $item->setShipment($this->getShippingAddress($country, null));
        $calculableObject->addItem($item);

        $calculator = new ProductItemTaxRateByRegionCalculator($this->queryContainerMock, $this->taxFacadeMock);

        $calculatedObject = $calculator->recalculateWithCalculableObject($calculableObject);

        $this->assertEquals('19.00', $calculatedObject->getItems()[0]->getTaxRate());
    }

    /**
     * @return void
     */
    public function testRecalculateWithCalculableObjectWithRegion(): void
    {
        $country = 'US';
        $idProductAbstract = 1;
        $region = 10;
        $this->taxSetQueryMock
            ->method('find')
            ->willReturn($this->getTaxObject($country, $idProductAbstract));
        $this->queryContainerMock
            ->method('queryTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions')
            ->with([$idProductAbstract], [$country], [$region])
            ->willReturn($this->taxSetQueryMock);

        $calculableObject = new CalculableObjectTransfer();
        $item = new ItemTransfer();
        $item->setIdProductAbstract($idProductAbstract);
        $item->setShipment($this->getShippingAddress($country, $region));
        $calculableObject->addItem($item);

        $calculator = new ProductItemTaxRateByRegionCalculator($this->queryContainerMock, $this->taxFacadeMock);

        $calculatedObject = $calculator->recalculateWithCalculableObject($calculableObject);
        $this->assertEquals('19.00', $calculatedObject->getItems()[0]->getTaxRate());
    }

    /**
     * @param string $country
     * @param null|int $region
     *
     * @return \Generated\Shared\Transfer\ShipmentTransfer
     */
    protected function getShippingAddress(string $country, ?int $region): ShipmentTransfer
    {
        $address = (new AddressTransfer())
            ->setIso2Code($country)
            ->setFkRegion($region);

        return (new ShipmentTransfer())
            ->setShippingAddress($address);
    }

    /**
     * @param string $country
     * @param int $idProductAbstract
     *
     * @return \Propel\Runtime\Collection\ArrayCollection
     */
    protected function getTaxObject(string $country, int $idProductAbstract): ArrayCollection
    {
        $taxObject = new ArrayCollection();
        $taxObject->setData([
            [
                'IdProductAbstract' => $idProductAbstract,
                'COUNTRY_CODE' => $country,
                'MaxTaxRate' => '19.00',
            ]
        ]);
        return $taxObject;
    }
}
