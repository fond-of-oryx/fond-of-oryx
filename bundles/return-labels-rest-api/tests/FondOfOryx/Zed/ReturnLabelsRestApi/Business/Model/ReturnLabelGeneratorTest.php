<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper\ReturnLabelRequestMapper;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeBridge;
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

        $this->returnLabelGenerator = new ReturnLabelGenerator(
            $this->companyUnitAddressReaderMock,
            $this->returnLabelFacadeMock,
            $this->returnLabelRequestMapperMock
        );

        parent::_before();
    }

    /**
     * @return void
     */
    public function testGenerateSuccess(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddressByRestReturnLabel')
            ->willReturn(42);

        $response = $this->returnLabelGenerator->generate($this->restReturnLabelRequestTransferMock);

        $this->assertInstanceOf(RestReturnLabelResponseTransfer::class, $response);
        $this->assertEquals(true, $response->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testGenerateFailed(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddressByRestReturnLabel')
            ->willReturn(null);

        $response = $this->returnLabelGenerator->generate($this->restReturnLabelRequestTransferMock);

        $this->assertInstanceOf(RestReturnLabelResponseTransfer::class, $response);
        $this->assertEquals(false, $response->getIsSuccessful());
    }
}
