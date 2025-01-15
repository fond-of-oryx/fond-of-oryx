<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;

class CompanyBusinessUnitReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $idCustomerFilterMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitUuidFilterMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReader
     */
    protected $companyBusinessUnitReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->idCustomerFilterMock = $this->getMockBuilder(IdCustomerFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitUuidFilterMock = $this->getMockBuilder(CompanyBusinessUnitUuidFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitCartSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->companyBusinessUnitReader = new CompanyBusinessUnitReader(
            $this->idCustomerFilterMock,
            $this->companyBusinessUnitUuidFilterMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetIdByFilterFields(): void
    {
        $self = $this;

        $idCompanyBusinessUnit = 1;
        $idCustomer = 1;
        $companyBusinessUnitUuid = 'd5ffcf7e-183f-4aa1-819e-74acf9f6a134';

        $callCount = $this->atLeastOnce();
        $this->idCustomerFilterMock->expects($callCount)
            ->method('filterByFilterField')
            ->willReturnCallback(static function (FilterFieldTransfer $filterFieldTransfer) use ($self, $callCount, $idCustomer) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($self->filterFieldTransferMocks[0], $filterFieldTransfer);

                        return $idCustomer;
                    case 2:
                        $self->assertSame($self->filterFieldTransferMocks[1], $filterFieldTransfer);

                        return null;
                }

                throw new Exception('Unexpected call count');
            });

        $this->companyBusinessUnitUuidFilterMock->expects(static::atLeastOnce())
            ->method('filterByFilterField')
            ->with($this->filterFieldTransferMocks[0])
            ->willReturn($companyBusinessUnitUuid);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCompanyBusinessUnitByIdCustomerAndCompanyBusinessUnitUuid')
            ->with(
                $idCustomer,
                $companyBusinessUnitUuid,
            )->willReturn($idCompanyBusinessUnit);

        static::assertEquals(
            $idCompanyBusinessUnit,
            $this->companyBusinessUnitReader->getIdByFilterFields($this->filterFieldTransferMocks),
        );
    }

    /**
     * @return void
     */
    public function testGetIdByFilterFieldsWithInvalidFilterFields(): void
    {
        $self = $this;

        $idCustomer = 1;

        $callCount = $this->atLeastOnce();
        $this->idCustomerFilterMock->expects($callCount)
            ->method('filterByFilterField')
            ->willReturnCallback(static function (FilterFieldTransfer $filterFieldTransfer) use ($self, $callCount, $idCustomer) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($self->filterFieldTransferMocks[0], $filterFieldTransfer);

                        return $idCustomer;
                    case 2:
                        $self->assertSame($self->filterFieldTransferMocks[1], $filterFieldTransfer);

                        return null;
                }

                throw new Exception('Unexpected call count');
            });

        $this->companyBusinessUnitUuidFilterMock->expects(static::atLeastOnce())
            ->method('filterByFilterField')
            ->with($this->filterFieldTransferMocks[0])
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
            ->method('getIdCompanyBusinessUnitByIdCustomerAndCompanyBusinessUnitUuid');

        static::assertEquals(
            null,
            $this->companyBusinessUnitReader->getIdByFilterFields($this->filterFieldTransferMocks),
        );
    }
}
