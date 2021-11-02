<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport\Communication\Plugin\DataImport;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportFacade;
use FondOfOryx\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;

class ShipmentTableRateDataImportPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTableRateDataImportFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterConfigurationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterConfigurationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterReportTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterReportTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\Communication\Plugin\DataImport\ShipmentTableRateDataImportPlugin
     */
    protected $shipmentTableRateDataImportPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->shipmentTableRateDataImportFacadeMock = $this->getMockBuilder(ShipmentTableRateDataImportFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterConfigurationTransferMock = $this->getMockBuilder(DataImporterConfigurationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterReportTransferMock = $this->getMockBuilder(DataImporterReportTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateDataImportPlugin = new ShipmentTableRateDataImportPlugin();
        $this->shipmentTableRateDataImportPlugin->setFacade($this->shipmentTableRateDataImportFacadeMock);
    }

    /**
     * @return void
     */
    public function testImport(): void
    {
        $this->shipmentTableRateDataImportFacadeMock->expects(static::atLeastOnce())
            ->method('import')
            ->with($this->dataImporterConfigurationTransferMock)
            ->willReturn($this->dataImporterReportTransferMock);

        static::assertEquals(
            $this->dataImporterReportTransferMock,
            $this->shipmentTableRateDataImportPlugin->import($this->dataImporterConfigurationTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetImportType(): void
    {
        static::assertEquals(
            ShipmentTableRateDataImportConfig::IMPORT_TYPE_SHIPMENT_TABLE_RATE,
            $this->shipmentTableRateDataImportPlugin->getImportType(),
        );
    }
}
