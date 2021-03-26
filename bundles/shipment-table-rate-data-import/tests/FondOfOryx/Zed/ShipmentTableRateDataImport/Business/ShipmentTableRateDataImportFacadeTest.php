<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

class ShipmentTableRateDataImportFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTableRateDataImportBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\Business\Model\ShipmentTableRateWriterStep|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterConfigurationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterConfigurationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterReportTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterReportTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportFacade
     */
    protected $shipmentTableRateDataImportFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->shipmentTableRateDataImportBusinessFactoryMock = $this->getMockBuilder(ShipmentTableRateDataImportBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterMock = $this->getMockBuilder(DataImporterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterConfigurationTransferMock = $this->getMockBuilder(DataImporterConfigurationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterReportTransferMock = $this->getMockBuilder(DataImporterReportTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateDataImportFacade = new ShipmentTableRateDataImportFacade();
        $this->shipmentTableRateDataImportFacade->setFactory($this->shipmentTableRateDataImportBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testImport(): void
    {
        $this->shipmentTableRateDataImportBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createShipmentTableRateImporter')
            ->willReturn($this->dataImporterMock);

        $this->dataImporterMock->expects(static::atLeastOnce())
            ->method('import')
            ->with($this->dataImporterConfigurationTransferMock)
            ->willReturn($this->dataImporterReportTransferMock);

        static::assertEquals(
            $this->dataImporterReportTransferMock,
            $this->shipmentTableRateDataImportFacade->import($this->dataImporterConfigurationTransferMock)
        );
    }
}
