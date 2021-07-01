<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapper;
use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class JellyfishOrderAddressMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface
     */
    protected $jellyfishOrderAddressMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderAddress
     */
    protected $spySalesOrderAddressMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Country\Persistence\SpyCountry
     */
    protected $spyCountryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesOrderAddressMock = $this->getMockBuilder(SpySalesOrderAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCountryMock = $this->getMockBuilder(SpyCountry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderAddressMapper = new JellyfishOrderAddressMapper([]);
    }

    /**
     * @return void
     */
    public function testFromSalesOrderItem(): void
    {
        $data = [
            'id_sales_order_address' => 1,
            'firstname' => 'Max',
            'lastname' => 'Mustermann',
            'address1' => 'strasse 12',
            'address2' => '',
            'address3' => '',
            'city' => 'Berlin',
            'zipcode' => '10119',
            'phone' => '555-55551',
            'country' => 'DE',
        ];

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn($data['id_sales_order_address']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getFirstName')
            ->willReturn($data['firstname']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getLastName')
            ->willReturn($data['lastname']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getAddress1')
            ->willReturn($data['address1']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getAddress2')
            ->willReturn($data['address2']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getAddress3')
            ->willReturn($data['address3']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getCity')
            ->willReturn($data['city']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getZipCode')
            ->willReturn($data['zipcode']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getPhone')
            ->willReturn($data['phone']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->spyCountryMock);

        $this->spyCountryMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($data['country']);

        $jellyfishOrderAddressTransfer = $this->jellyfishOrderAddressMapper->fromSalesOrderAddress($this->spySalesOrderAddressMock);

        $this->assertInstanceOf(JellyfishOrderAddressTransfer::class, $jellyfishOrderAddressTransfer);
        $this->assertEquals($data['id_sales_order_address'], $jellyfishOrderAddressTransfer->getId());
        $this->assertEquals($data['firstname'], $jellyfishOrderAddressTransfer->getName1());
        $this->assertEquals($data['lastname'], $jellyfishOrderAddressTransfer->getName2());
        $this->assertEquals($data['address1'], $jellyfishOrderAddressTransfer->getAddress1());
        $this->assertEquals($data['address2'], $jellyfishOrderAddressTransfer->getAddress2());
        $this->assertEquals($data['address3'], $jellyfishOrderAddressTransfer->getAddress3());
        $this->assertEquals($data['city'], $jellyfishOrderAddressTransfer->getCity());
        $this->assertEquals($data['zipcode'], $jellyfishOrderAddressTransfer->getZipCode());
        $this->assertEquals($data['phone'], $jellyfishOrderAddressTransfer->getPhone());
        $this->assertEquals($data['country'], $jellyfishOrderAddressTransfer->getCountry());
    }
}
