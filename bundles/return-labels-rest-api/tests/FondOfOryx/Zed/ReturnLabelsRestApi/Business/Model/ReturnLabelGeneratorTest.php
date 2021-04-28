<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapper;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeBridge;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;

class ReturnLabelGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestMapperMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGeneratorInterface
     */
    protected $returnLabelGenerator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUnitAddressReaderMock = $this->getMockBuilder(CompanyUnitAddressReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelFacadeMock = $this->getMockBuilder(ReturnLabelsRestApiToReturnLabelFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestMapperMock = $this->getMockBuilder(ReturnLabelRequestMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelsRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelGenerator = new ReturnLabelGenerator(
            $this->companyUnitAddressReaderMock,
            $this->returnLabelFacadeMock,
            $this->returnLabelRequestMapperMock,
            $this->configMock
        );

        parent::_before();
    }

    /**
     * @return void
     */
    public function testGenerateSuccess(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressByRestReturnLabel')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCountry')
            ->willReturn(60);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAllowedCountryIds')
            ->willReturn([60]);

        $response = $this->returnLabelGenerator->generate($this->restReturnLabelRequestTransferMock);

        $this->assertInstanceOf(RestReturnLabelResponseTransfer::class, $response);
        $this->assertEquals(true, $response->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testGenerateAddressNotFound(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressByRestReturnLabel')
            ->willReturn(null);

        $response = $this->returnLabelGenerator->generate($this->restReturnLabelRequestTransferMock);

        $this->assertInstanceOf(RestReturnLabelResponseTransfer::class, $response);
        $this->assertEquals(false, $response->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testGenerateAddressCountryNotAllowed(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressByRestReturnLabel')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCountry')
            ->willReturn(99);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAllowedCountryIds')
            ->willReturn([60]);

        $response = $this->returnLabelGenerator->generate($this->restReturnLabelRequestTransferMock);

        $this->assertInstanceOf(RestReturnLabelResponseTransfer::class, $response);
        $this->assertEquals(false, $response->getIsSuccessful());
    }
}
