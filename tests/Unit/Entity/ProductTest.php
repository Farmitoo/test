<?php


namespace App\Tests\Unit\Entity;

use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\ShippingFees;
use App\Entity\Tva;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetTitle()
    {
        $shippingFeesFarmitoo = new ShippingFees(20, 3);
        $tvaFarmitoo = new Tva(20);
        $brandFarmitoo = new Brand(1, 'Farmitoo', $tvaFarmitoo, $shippingFeesFarmitoo);
        $product = new Product(1, 'Cuve à gasoil', 100, $brandFarmitoo);

        $this->assertSame('Cuve à gasoil', $product->getTitle());
    }
}
