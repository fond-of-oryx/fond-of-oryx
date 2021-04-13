<?php


namespace FondOfOryx\Zed\ReturnLabel\Business\Model;


use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapper;

class ReturnLabelGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAdapterMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAddressMapperMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressReaderMock = $this->getMockBuilder(CompanyUnitAddressReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelAdapterMock = $this->getMockBuilder(ReturnLabelAdapter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelAddressMapperMock = $this->getMockBuilder(ReturnLabelAddressMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new ReturnLabelGenerator(
            $this->companyUnitAddressReaderMock,
            $this->returnLabelAdapterMock,
            $this->returnLabelAddressMapperMock
        );
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        // TODO: Test everything within MS and complete tests!
    }
}
