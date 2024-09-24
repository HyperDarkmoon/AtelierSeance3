<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    #[Route('/show/{name}', name: 'app_author')]
    public function index(string $name): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }

    private $authors = array(
        array('id' => 1, 'picture' => '/imgs/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/imgs/william-shakespeare.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/imgs/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
    );

    #[Route('/list', name: 'list_authors')]
    public function listAuthors(): Response
    {
        return $this->render('author/list.html.twig', [
            'authors' => $this->authors,
        ]);
    }
    #[Route('/{id}', name: 'author_details')]
    public function authorDetails(int $id): Response
    {
        $author = null;

        foreach ($this->authors as $a) {
            if ($a['id'] === $id) {
                $author = $a;
                break;
            }
        }

        if (!$author) {
            throw $this->createNotFoundException('Author not found');
        }

        return $this->render('author/showAuthor.html.twig', [
            'author' => $author,
        ]);
    }
}
