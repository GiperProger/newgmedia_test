<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;


class UserController extends AbstractController
{
    public function __construct(
        protected UserRepository              $userRepository,
        protected SerializerInterface         $serializer,
        protected UserPasswordHasherInterface $hasher,
        protected EntityManagerInterface $entityManager
    )
    {}

    #[Route('/', name:'userList', methods: ['GET'])]
    public function list(Request $request): Response
    {
        $formData = $request->query->all();
        $criteriaValue = null;
        $criteria = null;

        if( $formData ){
            $criteriaValue  = $formData['form']['criteriaValue'];
            $criteria  = $formData['form']['criteria'];
        }

        $form = $this->createFormBuilder()
        ->add('criteria', ChoiceType::class, [
            'choices'  => [
                'username' => 'username',
                'email' => 'email',
            ],
        ])
        ->add('criteriaValue', TextType::class, [
            'attr' => ['value' => $criteriaValue],
        ])
        ->add('submit', SubmitType::class)
            ->setMethod('GET')
            ->setRequired(false)
            ->setAction($this->generateUrl('userList'))
            ->getForm();

        if( $criteriaValue ){
            $userList = $this->userRepository->findBy( [$criteria => $criteriaValue] );
        }else{
            $userList = $this->userRepository->findAll();
        }

        return $this->render('list.html.twig', ['userList' => $userList, 'form' => $form->createView()]);
    }

    #[Route('/user', methods: ['GET'])]
    public function get(): Response
    {
        $userList = $this->userRepository->findAll();

        $data = $this->serializer->serialize($userList, JsonEncoder::FORMAT);
        return new Response($data);
    }

    #[Route('/user/{id<\d+>}/username/{username}/email/{email}/password/{password}/', methods: ['PUT'])]
    public function edit(int $id, $username, $email, $password): Response
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return new Response('User not found', 404);
        }

        try {
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($this->hasher->hashPassword($user, $password));

            $this->entityManager->flush();
        } catch (Exception $e) {
            return new Response($e->getMessage(), 422);
        }

        return new Response('User data updated');
    }

    #[Route('/user/', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $email = $request->query->get('email');
        $username = $request->query->get('username');
        $password = $request->query->get('password');

        if (!$email || !$username || !$password) {
            return new Response('Data is incorrect', 400);
        }

        try {

            $user = new User();

            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($this->hasher->hashPassword($user, $password));

            $this->entityManager->persist($user);
            $this->entityManager->flush();

        } catch (Exception $e) {
            return new Response($e->getMessage(), 422);
        }

        return new Response('User created');
    }

}
