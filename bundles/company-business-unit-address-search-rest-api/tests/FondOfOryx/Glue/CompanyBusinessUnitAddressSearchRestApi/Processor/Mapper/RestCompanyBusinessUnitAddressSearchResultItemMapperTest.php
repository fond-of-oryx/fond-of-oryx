<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer;

class RestCompanyBusinessUnitAddressSearchResultItemMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $companyBusinessUnitAddressListTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchResultItemMapper
     */
    protected $restCompanyBusinessUnitAddressSearchResultItemMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListTransferMocks = [
            $this->getMockBuilder(CompanyBusinessUnitAddressTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanyBusinessUnitAddressSearchResultItemMapper = new RestCompanyBusinessUnitAddressSearchResultItemMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyBusinessUnitAddressList(): void
    {
        $uuid = 'fd06fbea-7435-4838-8f0b-e8bee1efd0a5';

        $this->companyBusinessUnitAddressListTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitAddresses')
            ->willReturn(new ArrayObject($this->companyBusinessUnitAddressListTransferMocks));

        $this->companyBusinessUnitAddressListTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn(['uuid' => $uuid]);

        $restCompanyBusinessUnitAddressSearchResultItemTransfers = $this->restCompanyBusinessUnitAddressSearchResultItemMapper->fromCompanyBusinessUnitAddressList(
            $this->companyBusinessUnitAddressListTransferMock
        );

        static::assertCount(1, $restCompanyBusinessUnitAddressSearchResultItemTransfers);

        static::assertEquals(
            $uuid,
            $restCompanyBusinessUnitAddressSearchResultItemTransfers->offsetGet(0)->getUuid()
        );
    }
}
