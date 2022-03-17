<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;

class AddressExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CountryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $countryTransferMock;

    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\AddressExpander
     */
    protected $addressExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CountryOmsMailConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMock = $this->getMockBuilder(CountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressExpander = new AddressExpander($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $fkCountry = 1;
        $iso2Code = 'DE';

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCountry')
            ->willReturn($fkCountry);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn(null);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn(null);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCountryByIdCountry')
            ->with($fkCountry)
            ->willReturn($this->countryTransferMock);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('setCountry')
            ->with($this->countryTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->countryTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($iso2Code);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('setIso2Code')
            ->with($iso2Code)
            ->willReturn($this->addressTransferMock);

        static::assertEquals(
            $this->addressTransferMock,
            $this->addressExpander->expand($this->addressTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNonExistingCountry(): void
    {
        $fkCountry = 1;
        $iso2Code = 'DE';

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCountry')
            ->willReturn($fkCountry);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn(null);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn(null);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCountryByIdCountry')
            ->with($fkCountry)
            ->willReturn(null);

        $this->addressTransferMock->expects(static::never())
            ->method('setCountry');

        $this->addressTransferMock->expects(static::never())
            ->method('setIso2Code');

        static::assertEquals(
            $this->addressTransferMock,
            $this->addressExpander->expand($this->addressTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithAlreadyExpandedData(): void
    {
        $fkCountry = 1;

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCountry')
            ->willReturn($fkCountry);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->countryTransferMock);

        $this->addressTransferMock->expects(static::never())
            ->method('getIso2Code');

        $this->repositoryMock->expects(static::never())
            ->method('getCountryByIdCountry');

        $this->addressTransferMock->expects(static::never())
            ->method('setCountry');

        $this->countryTransferMock->expects(static::never())
            ->method('getIso2Code');

        $this->addressTransferMock->expects(static::never())
            ->method('setIso2Code');

        static::assertEquals(
            $this->addressTransferMock,
            $this->addressExpander->expand($this->addressTransferMock),
        );
    }
}
