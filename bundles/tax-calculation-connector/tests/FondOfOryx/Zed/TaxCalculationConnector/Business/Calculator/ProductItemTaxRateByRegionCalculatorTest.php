<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepository;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Generated\Shared\Transfer\TaxCalculationConnectorProductTaxSetTransfer;
use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;

class ProductItemTaxRateByRegionCalculatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface
     */
    private $taxFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockBuilder|\FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepository
     */
    private $repositoryMock;

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

        $this->repositoryMock = $this->getMockBuilder(TaxCalculationConnectorRepository::class)
            ->onlyMethods(
                [
                'getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions',
                'getTaxSetByIdProductAbstractAndCountryIso2Codes',
                ],
            )
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
        $region = null;

        $this->transferMock->addProductTaxSets(
            (new TaxCalculationConnectorProductTaxSetTransfer())
                ->setCountryIso2Code($country)
                ->setIdAbstractProduct($idProductAbstract)
                ->setMaxTaxRate(19.00),
        );

        $this->repositoryMock
            ->method('getTaxSetByIdProductAbstractAndCountryIso2Codes')
            ->with([$idProductAbstract], [$country])
            ->willReturn($this->transferMock);

        $calculableObject = $this->createCalculableObject($idProductAbstract, $country, $region);

        $calculator = new ProductItemTaxRateByRegionCalculator($this->repositoryMock, $this->taxFacadeMock);

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
                ->setMaxTaxRate(16.00),
        );

        $this->repositoryMock
            ->method('getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions')
            ->with([$idProductAbstract], [$country], [$region])
            ->willReturn($this->transferMock);

        $calculableObject = $this->createCalculableObject($idProductAbstract, $country, $region);

        $calculator = new ProductItemTaxRateByRegionCalculator($this->repositoryMock, $this->taxFacadeMock);

        $calculatedObject = $calculator->recalculateWithCalculableObject($calculableObject);
        $this->assertEquals(16.00, $calculatedObject->getItems()[0]->getTaxRate());
    }

    /**
     * @return void
     */
    public function testRecalculateWithCalculableObjectWithDefaultTax(): void
    {
        $country = 'US';
        $idProductAbstract = 1;
        $region = 10;

        $this->taxFacadeMock->method('getDefaultTaxRate')->willReturn(20.00);

        $this->repositoryMock
            ->method('getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions')
            ->with([$idProductAbstract], [$country], [$region])
            ->willReturn($this->transferMock);

        $calculableObject = $this->createCalculableObject($idProductAbstract, $country, $region);

        $calculator = new ProductItemTaxRateByRegionCalculator($this->repositoryMock, $this->taxFacadeMock);

        $calculatedObject = $calculator->recalculateWithCalculableObject($calculableObject);
        $this->assertEquals(20.00, $calculatedObject->getItems()[0]->getTaxRate());
    }

    /**
     * @param int $idProductAbstract
     * @param string $country
     * @param int|null $region
     *
     * @return \Generated\Shared\Transfer\CalculableObjectTransfer
     */
    protected function createCalculableObject(int $idProductAbstract, string $country, ?int $region): CalculableObjectTransfer
    {
        $calculableObject = new CalculableObjectTransfer();
        $item = new ItemTransfer();
        $item->setIdProductAbstract($idProductAbstract);
        $item->setShipment($this->getShippingAddress($country, $region));
        $calculableObject->addItem($item);

        return $calculableObject;
    }

    /**
     * @param string $country
     * @param int|null $region
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
