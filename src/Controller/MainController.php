<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Item;
use App\Entity\Order\OrderPrice;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Entity\ShippingFees;
use App\Entity\Tva;
use App\Service\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    public function index(): Response
    {
        $shippingFeesFarmitoo = new ShippingFees(20, 3);
        $shippingFeesGallagher = new ShippingFees(15, null);

        $tvaFarmitoo = new Tva(20);
        $tvaGallagher = new Tva(5);

        $brandFarmitoo = new Brand(1, 'Farmitoo', $tvaFarmitoo, $shippingFeesFarmitoo);
        $brandGallagher = new Brand(2, 'Gallagher', $tvaGallagher, $shippingFeesGallagher);

        $product1 = new Product(1,'Cuve à gasoil', 250000, $brandFarmitoo);
        $product2 = new Product(2,'Nettoyant pour cuve', 5000, $brandFarmitoo);
        $product3 = new Product(3,'Piquet de clôture', 1000, $brandGallagher);

        // je pars du principe que les promotions sont en pourcentage
        $promotion1 = new Promotion(50000, 8, false);

        // Je passe une commande avec
        // Cuve à gasoil x1
        // Nettoyant pour cuve x3
        // Piquet de clôture x5

        $item1 = new Item($product1, 1);
        $item2 = new Item($product2, 3);
        $item3 = new Item($product3, 5);

        $order = new OrderPrice();
        $order->addItem($item1);
        $order->addItem($item2);
        $order->addItem($item3);

        $basketService = new BasketService();
        $basketService->calculateOrderPrice($order);

        return $this->render('basket/basket.html.twig', [
            $order
        ]);
    }
}
