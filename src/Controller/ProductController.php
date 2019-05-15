<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class ProductController extends FOSRestController
{
    /**
     * @Rest\Get("/product")
//     * @QueryParam(name="limit", default="50")
//     * @QueryParam(name="offset", default="1")
     */
    public function getAllProductsAction(Request $request)
    {
        $limit = $request->get('limit');
        $offset = $request->get('offset');
        $result = $this->getDoctrine()->getRepository('App\Entity\Product')->findAll();
        if ($result === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
//        $adapter = new DoctrineORMAdapter($result);
//
//        $paginator = new Pagerfanta($adapter);
//        $paginator->setMaxPerPage($limit);
//        $paginator->setCurrentPage($offset);
//        return array("cdrData"=>$this->toArrayFormat($paginator),"nbPages"=>$paginator->getNbPages());
        return $result;
    }
    /**
     * @Rest\Get("/product/{category}")
     */
    public function getProductByIDCategories($category)
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('App\Entity\Product')->findProductByCategory($category);
        return $result;
    }
    /**
     * @Rest\Get("/Category")
     */
    public function getListCategory()
    {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('App\Entity\Product')->findListCategory();
        return $result;
    }
    public function toArrayFormat($jsonArray) {
        $array = array();
        foreach ($jsonArray as $element) {
            $array[] = $element;
        }

        return $array;
    }
    /**
     * @Rest\Post("/product")
     */
   public function insertProducts(){
       $url = 'http://test.ats-digital.com:3000/products';
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

       $response = curl_exec($ch);
       $dataJson = json_decode($response, true);

       foreach ($dataJson as $data) {

           $product = new Product();
           $reviews = $data['reviews'];
           foreach ($reviews as $r ){
               $review = new Review();

               $review ->setRating($r['rating']);
               $review->setContent($r['content']);
           }

           $em1 = $this->getDoctrine()->getManager();
           $em1->persist($review);
           $em1->flush();
           $product->setProductmaterial($data['productMaterial']);
           $product->setDetails($data['details']);
           $product->setDelivery($data['delivery']);
           $product->setImageurl($data['imageUrl']);
           $product->setBrand($data['brand']);
           $product->setBaseprice($data['basePrice']);
           $product->setProductname($data['productName']);
           $product->setCategory($data['category']);
           $product->setReviews($review);
           $em = $this->getDoctrine()->getManager();
           $em->persist($product);
           $em->flush();
       }           return new View("product Added Successfully", Response::HTTP_OK);

   }
}
