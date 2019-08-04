<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProductsController extends ApiController
{

    /**
     * @Route("/products", methods="GET", name="products_index")
     */
    public function indexAction(ProductRepository $productRepository)
    {
        $products = $productRepository->transformAll();

        return $this->respond($products);
    }

    /**
    * @Route("/products", methods="POST")
    */
    public function createAction(Request $request, ProductRepository $productRepository, EntityManagerInterface $em)
    {
        

        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the request attributes
        if (! $request->get('title')) {
            return $this->respondValidationError('Please provide a title!');
        }
        if (! $request->get('content')) {
            return $this->respondValidationError('Please provide a description content');
        }
        if (! $request->get('status')) {
            return $this->respondValidationError('Please provide a description status');
        }

        // data validation by regex 

        // persist the new product
        $product = new Product;
        $product->setTitle($request->get('title'));
        $product->setContent($request->get('content'));
        $product->setStatus($request->get('status'));
        $product->setCreatedAt(new \Datetime('now', new \DateTimeZone('Europe/Paris')));
        $em->persist($product);
        $em->flush();

        return $this->respondCreated($productRepository->transform($product));
    }

}
