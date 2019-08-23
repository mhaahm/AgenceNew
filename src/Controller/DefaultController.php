<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 06/11/18
 * Time: 21:25
 */

namespace App\Controller;
use App\Entity\Property;
use App\Entity\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;
use Faker\Factory;
use App\Form\PropertySearchType;


class DefaultController extends AbstractController
{

    /**
     * @var Environment
     */
    private $twig;


    private $encoder;

    /**
     * DefaultController constructor.
     * @var Twig\Environment
     */
    public function __construct(Environment $twig,UserPasswordEncoderInterface $encoder)
    {
        $this->twig = $twig;
        $this->encoder = $encoder;
    }

    public function index(PropertyRepository $repo,Request $request): Response
    {
        // get the latest Propertys
        $propertySearch = new PropertyType($request);
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        $propertys = $repo->getAllVisited($propertySearch);
        return new Response($this->twig->render("pages/home.html.twig",[
            'properties' => $propertys,
            'form' =>$form->createView()
        ]));
    }

    public function createUser(ObjectManager $obj)
    {
        /*$user = new User();
        $user->setUsername('demo');
        $user->setPassword($this->encoder->encodePassword($user,'demo'));
        $obj->persist($user);*/

        // create bien
        $faker = Factory::create('fr_FR');
        for ($i=0;$i<100;$i++)
        {

            $property = new Property();
            $property->setAdress($faker->address)
                ->setBedrooms($faker->numberBetween(1,9))
                ->setRooms($faker->numberBetween(2,10))
                ->setCity($faker->city)
                ->setDescription($faker->sentences(3,true))
                ->setFloor($faker->numberBetween(0,15))
                ->setPostalCode($faker->postcode)
                ->setPrice($faker->numberBetween(100000,300000))
                ->setTitle($faker->words(3,true))
                ->setSurface($faker->numberBetween(20,350))
                ->setSold(false)
                ->setHeat($faker->numberBetween(0,count(Property::HEAT) - 1));
            $obj->persist($property);

        }
        $obj->flush();
        return new Response("User created");
    }
}