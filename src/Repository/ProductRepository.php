<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function transform(Product $product)
    {
        $url_parts = preg_split("/http:\/\/res.cloudinary.com\/jlange-et-dada\/image\/upload/", $product->getImage());   
        $image = "http://res.cloudinary.com/jlange-et-dada/image/upload/w_214,h_121/" . $url_parts[1];
        return [
                'id'    => (int) $product->getId(),
                'title' => (string) $product->getTitle(),
                'status' => (string) $product->getStatus(),
                'image' => (string) $image,
                'content' => (string) $product->getContent(),
                'created_at' => $product->getCreatedAt()
        ];
    }

    public function transformAll()
    {
        $products = $this->findAll();
        $productsArray = [];
        foreach ($products as $product) {
            $productsArray[] = $this->transform($product);
        }
        return $productsArray;
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
