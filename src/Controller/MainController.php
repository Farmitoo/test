<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Product;
use App\Entity\Discount;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", methods="GET", name="index")
     */
    public function index(OrderService $orderService): Response
    {
        /**
         * J'ai ajouté un attribut tva sur le produit afin d'anticiper une potentielle tva par produit
         */
        $product1 = new Product('Cuve à gasoil', 250000, 'Farmitoo', '10 0001', 20);
        $product2 = new Product('Nettoyant pour cuve', 5000, 'Farmitoo', '10 0002', 20);
        $product3 = new Product('Piquet de clôture', 1000, 'Gallagher', '10 0003', 20);

        /**
         * Classe Discount avec quelque attributs de base
         * code, montant minimal, reduction, livraison gratuite, nombre d'utilisations max, unique par client, ..
         */
        $promotion1 = new Discount('FARMITOO', 50000, 8, false);

        /**
         * Un item représente un produit et une quantité donnée pour ce produit
         */
        $items = [new Item($product1, 1), new Item($product2, 3), new Item($product3, 5)];

        /** COMMANDE */
        // Je passe une commande avec
        // Cuve à gasoil x1
        // Nettoyant pour cuve x3
        // Piquet de clôture x5

        /**
         * Pour l'exercice je fais passer la tva dans la fonction newOrder étant donné que cette dernière est fixe
         * Pour une potentielle évolution il suffirait d'utiliser celle assignée aux produits par exemple
         */
        $order = $orderService->newOrder($items, [$promotion1], 20, 20);

        return $this->render('index.html.twig', ['order' => $order]);
    }
}
