<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CompanyBusinessUnitResourceResourceReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitResourceReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->repositoryMock = $this->getMockBuilder(ReturnLabelRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new CompanyBusinessUnitResourceResourceReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetByReturnLabelRequest(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitByReturnLabelRequest')
            ->with($this->returnLabelRequestTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertInstanceOf(
            CompanyBusinessUnitTransfer::class,
            $this->reader->getByReturnLabelRequest($this->returnLabelRequestTransferMock)
        );
    }
}
