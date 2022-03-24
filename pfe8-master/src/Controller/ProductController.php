<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Entity\Product;
use App\Form\SearchType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager )
    {
        $this->entityManager=$entityManager;
    }

        #[Route('nos-produits', name: 'products')]
        public function index( Request $request){
            $search=new Search();
            $form=$this->createForm(SearchType::class,$search);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $products =$this->entityManager->getRepository(Product::class)->findWithSearch($search);
            }else{
                $products =$this->entityManager->getRepository(Product::class)->findAll();
            }
          return $this->render('product/index.html.twig',[
           'products' =>$products,
           'form' =>$form->createView()
          ]);
      }
      #[Route('produit/{slug}', name: 'product')]
      public function show($slug,EntityManagerInterface $em, Request $request){
        $product=$this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        if (! $product){
        return $this->redirectToRoute('products');
        }
         // Partie commentaires
        // On crée le commentaire "vierge"
        $comment = new Comments;

        // On génère le formulaire
        $commentForm = $this->createForm(CommentsType::class, $comment);

        $commentForm->handleRequest($request);

        // Traitement du formulaire
        if($commentForm->isSubmitted() && $commentForm->isValid()){
            $comment->setCreatedAt(new DateTime());
            $comment->setProduct($product);

            // On récupère le contenu du champ parentid
            $parentid = $commentForm->get("parentid")->getData();

            // On va chercher le commentaire correspondant

            if($parentid != null){
                $parent = $em->getRepository(Comments::class)->find($parentid);
            }

            // On définit le parent
            $comment->setParent($parent ?? null);

            $em->persist($comment);
            $em->flush();
            $this->addFlash('message', 'Votre commentaire a bien été envoyé');
        }

        return $this->render('product/show.html.twig',[
            'product' => $product,
            'commentForm' => $commentForm->createView()
        ]);
      }

}
