<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepository;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Generated\Shared\Transfer\TaxCalculationConnectorProductTaxSetTransfer;
use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;
use Propel\Runtime\Collection\ArrayCollection;
use FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface;
use \Orm\Zed\Tax\Persistence\SpyTaxSetQuery;

class ProductItemTaxRateByRegionCalculatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface
     */
    private $taxFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockBuilder|\FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepository
     */
    private $queryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    private $transferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->taxFacadeMock = $this->getMockBuilder(TaxCalculationConnectorToTaxInterface::class)
            ->getMock();


        $this->queryContainerMock = $this->getMockBuilder(TaxCalculationConnectorRepository::class)
            ->onlyMethods([
                'getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions',
                'getTaxSetByIdProductAbstractAndCountryIso2Codes'
            ])
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMock = new TaxCalculationConnectorTransfer();
    }

    /**
     * @return void
     */
    public function testRecalculateWithCalculableObjectWithoutRegion(): void
    {
        $country = 'DE';
        $idProductAbstract = 1;

        $this->transferMock->addProductTaxSets(
            (new TaxCalculationConnectorProductTaxSetTransfer())
                ->setCountryIso2Code($country)
                ->setIdAbstractProduct($idProductAbstract)
                ->setMaxTaxRate(19.00)
        );

        $this->queryContainerMock
            ->method('getTaxSetByIdProductAbstractAndCountryIso2Codes')
            ->with([$idProductAbstract], [$country])
            ->willReturn($this->transferMock);

        $calculableObject = new CalculableObjectTransfer();
        $item = new ItemTransfer();
        $item->setIdProductAbstract($idProductAbstract);
        $item->setShipment($this->getShippingAddress($country, null));
        $calculableObject->addItem($item);

        $calculator = new ProductItemTaxRateByRegionCalculator($this->queryContainerMock, $this->taxFacadeMock);

        $calculatedObject = $calculator->recalculateWithCalculableObject($calculableObject);

        $this->assertEquals(19.00, $calculatedObject->getItems()[0]->getTaxRate());
    }

    /**
     * @return void
     */
    public function testRecalculateWithCalculableObjectWithRegion(): void
    {
        $country = 'US';
        $idProductAbstract = 1;
        $region = 10;

        $this->transferMock->addProductTaxSets(
            (new TaxCalculationConnectorProductTaxSetTransfer())
                ->setCountryIso2Code($country)
                ->setIdAbstractProduct($idProductAbstract)
                ->setMaxTaxRate(16.00)
        );

        $this->queryContainerMock
            ->method('getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions')
            ->with([$idProductAbstract], [$country], [$region])
            ->willReturn($this->transferMock);

        $calculableObject = new CalculableObjectTransfer();
        $item = new ItemTransfer();
        $item->setIdProductAbstract($idProductAbstract);
        $item->setShipment($this->getShippingAddress($country, $region));
        $calculableObject->addItem($item);

        $calculator = new ProductItemTaxRateByRegionCalculator($this->queryContainerMock, $this->taxFacadeMock);

        $calculatedObject = $calculator->recalculateWithCalculableObject($calculableObject);
        $this->assertEquals(16.00, $calculatedObject->getItems()[0]->getTaxRate());
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

}
