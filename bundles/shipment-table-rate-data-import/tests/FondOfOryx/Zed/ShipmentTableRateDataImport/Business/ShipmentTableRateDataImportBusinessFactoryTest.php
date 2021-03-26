<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;
use Spryker\Zed\DataImport\DataImportDependencyProvider;
use Spryker\Zed\DataImport\Dependency\Facade\DataImportToGracefulRunnerInterface;
use Spryker\Zed\DataImport\Dependency\Propel\DataImportToPropelConnectionInterface;
use Spryker\Zed\Kernel\Container;

class ShipmentTableRateDataImportBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTableRateDataImportConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterConfigurationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterConfigurationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataImporterReaderConfigurationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\DataImport\Dependency\Propel\DataImportToPropelConnectionInterface
     */
    protected $propelConnectionMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\DataImport\Dependency\Facade\DataImportToGracefulRunnerInterface
     */
    protected $gracefulRunnerFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportBusinessFactory
     */
    protected $shipmentTableRateDataImportBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->shipmentTableRateDataImportConfigMock = $this->getMockBuilder(ShipmentTableRateDataImportConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterConfigurationTransferMock = $this->getMockBuilder(DataImporterConfigurationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataImporterReaderConfigurationTransferMock = $this->getMockBuilder(DataImporterReaderConfigurationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->propelConnectionMock = $this->getMockBuilder(DataImportToPropelConnectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gracefulRunnerFacadeMock = $this->getMockBuilder(DataImportToGracefulRunnerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateDataImportBusinessFactory = new ShipmentTableRateDataImportBusinessFactory();
        $this->shipmentTableRateDataImportBusinessFactory->setConfig($this->shipmentTableRateDataImportConfigMock);
        $this->shipmentTableRateDataImportBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateShipmentTableRateImporter(): void
    {
        $this->shipmentTableRateDataImportConfigMock->expects(static::atLeastOnce())
            ->method('getShipmentTableRateDataImporterConfiguration')
            ->willReturn($this->dataImporterConfigurationTransferMock);

        $this->dataImporterConfigurationTransferMock->expects(static::atLeastOnce())
            ->method('getReaderConfiguration')
            ->willReturn($this->dataImporterReaderConfigurationTransferMock);

        $this->dataImporterConfigurationTransferMock->expects(static::atLeastOnce())
            ->method('getImportType')
            ->willReturn(ShipmentTableRateDataImportConfig::IMPORT_TYPE_SHIPMENT_TABLE_RATE);

        $this->dataImporterReaderConfigurationTransferMock->expects(static::atLeastOnce())
            ->method('getDirectories')
            ->willReturn([codecept_root_dir('data' . DIRECTORY_SEPARATOR . 'import')]);

        $this->dataImporterReaderConfigurationTransferMock->expects(static::atLeastOnce())
            ->method('getFileName')
            ->willReturn('shipment_table_rate.csv');

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [DataImportDependencyProvider::FACADE_GRACEFUL_RUNNER],
                [DataImportDependencyProvider::PROPEL_CONNECTION]
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [DataImportDependencyProvider::FACADE_GRACEFUL_RUNNER],
                [DataImportDependencyProvider::PROPEL_CONNECTION]
            )
            ->willReturnOnConsecutiveCalls(
                $this->gracefulRunnerFacadeMock,
                $this->propelConnectionMock
            );

        static::assertInstanceOf(
            DataImporterInterface::class,
            $this->shipmentTableRateDataImportBusinessFactory->createShipmentTableRateImporter()
        );
    }
}
