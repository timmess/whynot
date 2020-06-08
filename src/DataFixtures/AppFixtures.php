<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use App\Entity\Artwork;
use Cocur\Slugify\Slugify;
use App\Entity\DiscussionTheme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        // Gestion des Users
        $users = [];

        for ($l=1; $l <= 10; $l++) { 
            $user = new User();

            $hash = $this->encoder->encodePassword($user, 'password');

            $user->setEmail($faker->email)
                 ->setPassword($hash);

        $manager->persist($user);
        $users[] = $user;
        }


        // Gestion des oeuvres
        for ($i=1; $i <= 20 ; $i++) { 
            $artwork = new Artwork();

            //Thèmes globaux

                // $artwork
                $title = $faker->sentence(1, 3);
                $synopsis = $faker->paragraph(15, 30);
                $shortDescription = $faker->sentences(2, 4);
                $globalRate = $faker->randomDigitNot(5);
                $imageUrl="http://placehold.it/600x400";

                $user = $users[mt_rand(0, count($users) - 1)];
                
                $artwork->setTitle($title)
                        ->setSynopsis($synopsis)
                        ->setShortDescription($shortDescription)
                        ->setGlobalRate($globalRate)
                        ->setImageUrl($imageUrl)
                        ->setUser($user);
                

                //NarrationTheme
                $narrationTheme = new DiscussionTheme();
                $narrationLabel = "Narration";
                $narrationCatchPhrase = "Veuillez donner votre avis sur la narration de l'oeuvre";
                $narrationDescription = "La narration est le récit de l'oeuvre, son histoire à proprement parlé, ses intrigues, sa forme ou son fond.";

                $narrationTheme->setLabel($narrationLabel)
                                ->setCatchPhrase($narrationCatchPhrase)
                                ->setDescription($narrationDescription)
                                ->addArtwork($artwork);


                $manager->persist($narrationTheme);

                //caractersTheme
                $personnagesTheme = new DiscussionTheme();
                $personnagesLabel = "Personnages";
                $personnagesCatchPhrase = "Cliquez ici pour parler de vos personnages préférés (ou pas) !";
                $personnagesDescription = "Les personnages sont tous les acteurs de l'histoire de l'oeuvre";

                $personnagesTheme->setLabel($personnagesLabel)
                                ->setCatchPhrase($personnagesCatchPhrase)
                                ->setDescription($personnagesDescription)
                                ->addArtwork($artwork);


                $manager->persist($personnagesTheme);

                //favoriteMomentTheme
                $favoriteMomentTheme = new DiscussionTheme();
                $favoriteMomentLabel = "Votre passage préféré";
                $favoriteMomentCatchPhrase = "Venez partager le moment de l'oeuvre qui vous a le plus marqué.";
                $favoriteMomentDescription = "Chacun possède sa propre lecture d'une oeuvre en fonction de son histoire, de son caractère, de ses sentiments etc. C'est pour cela que chacun va aimer une oeuvre pour telle ou telle raison. Dès lors, chacun est sensible à différentes facettes de l'histoire.";

                $favoriteMomentTheme->setLabel($favoriteMomentLabel)
                                    ->setCatchPhrase($favoriteMomentCatchPhrase)
                                    ->setDescription($favoriteMomentDescription)
                                    ->addArtwork($artwork);


                $manager->persist($favoriteMomentTheme);


            // Thèmes individuels
            
            for ($j=0; $j < 10 ; $j++) {
                $discussionTheme = new DiscussionTheme();

                // $discussionTheme
                $label = $faker->sentence(1, 3);
                $catchPhrase = $faker->sentences(2, 5);
                $description = $faker->sentences(5, 10);
    
                $discussionTheme->setLabel($label)
                                ->setCatchPhrase($catchPhrase)
                                ->setDescription($description)
                                ->addArtwork($artwork);

    
                $manager->persist($discussionTheme);
            }      
        $manager->persist($artwork);
        }
        
        
        $manager->flush();
    }
    
}
