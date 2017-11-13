<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Contracts\EntityManager as EntityManagerInterface;
use App\Books\Repositories\Contracts\BookRepository as BookRepositoryInterface;
use App\Books\Services\Contracts\BookInputMapperService as BookInputMapperServiceInterface;
use App\Books\Transformers\Contracts\BookTransformer as BookTransformerInterface;
use App\Services\Contracts\BookFactory as BookFactoryInterface;

class BooksController
{
    /**
     * @param Request $request
     * @param BookRepositoryInterface $bookRepository
     * @param BookTransformerInterface $bookTransformer
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function get(
        Request $request,
        BookRepositoryInterface $bookRepository,
        BookTransformerInterface $bookTransformer
    )
    {
        $filter = $request->get('filter');

        $books = $bookRepository->findBy($filter);

        if ($books->count() == 0) {
            return response("Not found", Response::HTTP_NOT_FOUND);
        }

        $transformedBooks = $bookTransformer->transformAll($books);

        return response($transformedBooks, Response::HTTP_OK);
    }

    /**
     * @param BookRequest $request
     * @param BookInputMapperServiceInterface $bookInputMapper
     * @param EntityManagerInterface $entityManager
     * @param BookTransformerInterface $bookTransformer
     * @param BookFactoryInterface $bookFactory
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function createPost(
        BookRequest $request,
        BookInputMapperServiceInterface $bookInputMapper,
        EntityManagerInterface $entityManager,
        BookTransformerInterface $bookTransformer,
        BookFactoryInterface $bookFactory
    )
    {
        $bookData = $request->all();

        $book = $bookFactory->make();
        $bookInputMapper->map($book, $bookData);
        $entityManager->persist($book);

        $transformedBook = $bookTransformer->transform($book);

        return response($transformedBook, Response::HTTP_CREATED);
    }

    /**
     * @param BookRepositoryInterface $bookRepository
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getCategories(BookRepositoryInterface $bookRepository)
    {
        $categories = $bookRepository->getCategories();

        return response($categories, Response::HTTP_OK);
    }
}
