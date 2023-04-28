<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer\RepresentativeCompanyUserWriter;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer\RepresentativeCompanyUserWriter
     */
    protected $writer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(RepresentativeCompanyUserEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->writer = new RepresentativeCompanyUserWriter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testWrite(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->writer->write($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testFlagState(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('flagState')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->writer->flagState('new', 'state');
    }
}
