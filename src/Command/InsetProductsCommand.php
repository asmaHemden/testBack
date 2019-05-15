<?php
/**
 * Created by PhpStorm.
 * User: Asma
 * Date: 16/05/2019
 * Time: 00:10
 */

namespace App\Command;


use App\Entity\Product;
use App\Entity\Review;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InsetProductsCommand extends Command
{

    protected  $em;
    protected  $em1;

    public function __construct(ObjectManager $em, ObjectManager $em1)
    {
        parent::__construct();
        $this->em = $em;
        $this->em1 = $em1;

    }
    protected function configure()
    {
        $this
            ->setName('app:insert-products')
            ->setDescription('insert products from web service')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '=================================================',
            '☺ veuillez patienter quelques secondes pour importer la liste des produits dans la base de donnée ☺',
            '=================================================',
            '',

        ]);
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

            $this->em1->persist($review);
            $this->em1->flush();
            $product->setProductmaterial($data['productMaterial']);
            $product->setDetails($data['details']);
            $product->setDelivery($data['delivery']);
            $product->setImageurl($data['imageUrl']);
            $product->setBrand($data['brand']);
            $product->setBaseprice($data['basePrice']);
            $product->setProductname($data['productName']);
            $product->setCategory($data['category']);
            $product->setReviews($review);
            $this->em->persist($product);
            $this->em->flush();
        }
        $output->write('products Added Successfully');

    }
}