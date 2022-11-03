<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;



class UserFixtures extends Fixture
{
    public function __construct(
        protected UserPasswordHasherInterface $hasher,
    )
    {}

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return [ 'mainGroup' ];
    }

    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for( $i = 0; $i < 10; $i++){
            $user = new User();
            $user->setUsername($faker->userName());
            $user->setEmail($faker->email());
            $user->setPassword($this->hasher->hashPassword($user, '1234'));
            $manager->persist($user);
        }

        $manager->flush();

    }
}
