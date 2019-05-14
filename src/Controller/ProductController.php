<?php

namespace App\Controller;

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
}
