<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{

    /**
     * @Route("/products/{id}", name="product_show")
     */
    public function showAction()
    {
        $product = new Product();
        $product
            ->setTitle('Product title')
            ->setContent('Product Content')
        ;
        $data = $this->get('jms_serializer')->serialize($product, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
