<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Items;
use App\Entity\Orders;
use App\Entity\Comments;
use App\Entity\Customers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Menus extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();
        //les customers
        $customers = [];
        $genres = ['male', 'female'];

        for($i=0; $i<=20; $i++) {
            $user = new Customers();

            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99).'.jpg';

            $picture .= ($genre == 'male' ? 'men/' : 'women/').$pictureId;

            //hash = $this->encoder->encodePassword($user, 'password');

            $user->setFirstName($faker->firstName($genre))
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setPassword('1234')
                ->setAvatar($picture)
                ->setJoinDate($faker->dateTime());
            $customers[] = $user;
            $manager->persist($user);
            $manager->flush();
            
        }
        
        //les items
        $it = array('Menu Classic','Menu Bacon','Menu Big','Menu Chicken','Menu Fish',
        'Menu Double Steak','Bacon','Chicken','Fish','Double Steak','Frites','Onion Rings',
        'Classic','Nuggets','Nuggets Fromage','Ailes de Poulet','César Poulet Pané',
        'Coca-Cola','Coca-Cola Light','Coca-Cola Zéro','Fanta','Sprite','Nestea',
        'Fondant au chocolat','Muffin','Beignet','Milkshake','Sundae');
        $items=[];
        for ($i=0; $i <= 26; $i++)
        {
            $item = new Items();
            $item->setName($it[$i])
                ->setDescription($faker->sentence())
                ->setPrice(mt_rand(0,20))
                ->setImage($faker->imageUrl($width = 200, $height = 200))
            ;

            $items[] = $item;
            $manager->persist($item);
            $manager->flush();
        }
        // orders
        $orders=[];
        for ($i = 0;$i <20; $i++)
        {
            $order = new Orders();
            $order->setCustomer($customers[$faker->numberBetween(0,19)]);
            $iter = $faker->randomDigit();
            for ($j= 0;$j < $iter;$j++)
            {
                $order->addItem($items[$faker->numberBetween(0,25)]);
            }
            //->setItem($items[$faker->numberBetween(0,25)])
            $order->setQuantite($faker->randomDigit())
                ->setOrderDate($faker->dateTime($max = 'now', $timezone = null))
            ;
            $orders[] = $order;
            $manager->persist($order);
            $manager->flush();

        }
        
        // the comments
        $comments = [];
        for ($i = 0; $i < 20; $i++) {
            $o = $orders[$faker->numberBetween(0,19)];
            $comment = new Comments();
            $comment->setAuthor($o->getCustomer()->getId());
            $comment->setOrderId($o->getId());
            $comment->setComment($faker->sentence(20));
            $manager->persist($order);
            $comments[] = $comment;
            $manager->persist($comment);
            $manager->flush();
        }
    }
}
