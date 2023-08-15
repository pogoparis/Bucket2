<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishFormType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class WishController extends AbstractController
{
    #[Route('/wish', name: 'app_wish_index')]
    public function index(
        WishRepository $wishRepository
    ): Response
    {
        $wishes = $wishRepository->findBy(
            ['isPublished' => true],
            ['dateCreated' => 'ASC']
        );
        return $this->render('wish/index.html.twig', compact('wishes'));
    }



    #[Route('/detail/{wish}',
        name: 'app_wish_detail',
        requirements: ["wish" => "\d+"]
    )]
    public function detail(
        Wish $wish
    ): Response
    {
        return $this->render('wish/detail.html.twig', compact("wish"));
    }

    #[Route('/creer',
        name: 'app_wish_creer'
    )]
    #[IsGranted('ROLE_USER')]
    public function creer(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $wish = new Wish();
        $wish->setAuthor($this->getUser()->getUserIdentifier());
        $wish->setIsPublished(1);
        $wish->setDateCreated(new \DateTime());

        $wishForm = $this->createForm(WishFormType::class, $wish);
        $wishForm->handleRequest($request);
        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $entityManager->persist($wish);
            $entityManager->flush();
            $this->addFlash('success', 'Votre Wish a bien été créé');
              return $this->redirectToRoute('app_wish_detail', [
                  'wish' => $wish->getId()]);
        }

        return $this->render('wish/creer.html.twig', compact("wishForm"));
    }

}
