<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\Controller;

class BookController extends Controller
{
    public function listAllBooks()
    {
        $bookModel = new BookModel();
        $books = $bookModel->select('id, title, description, author, pages, created_at')->findAll();

        return $this->response->setJSON($books);
    }

    public function listBooks($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->select('id, title, description, author, pages, created_at')->find($id);

        if (!$book) {
            return $this->response->setStatusCode(404)->setJSON([
                'message' => 'Book not found'
            ]);
        }

        return $this->response->setJSON($book);
    }
    
    public function addBook()
    {
        try {
            if (!$this->validate('book')) {
                return $this->response->setStatusCode(400)->setJSON([
                    'message' => \Config\Services::validation()->getErrors()
                ]);
            }

            $title = $this->request->getVar('title');
            $description = $this->request->getVar('description');
            $author = $this->request->getVar('author');
            $pages = $this->request->getVar('pages');

            $bookModel = new BookModel();

            $existingBook = $bookModel->where('title', $title)->first();
            if ($existingBook) {
                return $this->response->setStatusCode(409)->setJSON([
                    'message' => 'A book with the same title already exists'
                ]);
            }

            $book = [
                'title' => $title,
                'description' => $description,
                'author' => $author,
                'pages' => $pages,
            ];

            $bookModel->insert($book);

            return $this->response->setJSON(['message' => 'Book added successfully']);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'message' => 'An error occurred while adding the book'
            ]);
        }
    }

    public function updateBooks()
    {
        try {
            if (!$this->validate('bookUpdate')) {
                return $this->response->setStatusCode(400)->setJSON([
                    'message' => \Config\Services::validation()->getErrors()
                ]);
            }

            $id = $this->request->getVar('id');
            $title = $this->request->getVar('title');
            $description = $this->request->getVar('description');
            $author = $this->request->getVar('author');
            $pages = $this->request->getVar('pages');

            $bookModel = new BookModel();
            $existingBook = $bookModel->find($id);

            if (!$existingBook) {
                return $this->response->setStatusCode(404)->setJSON([
                    'message' => 'Book not found'
                ]);
            }

            $book = [
                'title' => $title,
                'description' => $description,
                'author' => $author,
                'pages' => $pages,
            ];

            $updateReturn = $bookModel->update($id, $book);

            if (!$updateReturn) {
                return $this->response->setStatusCode(500)->setJSON([
                    'message' => 'An error occurred while update the book'
                ]);
            }

            return $this->response->setJSON(['message' => 'Books updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'message' => 'An error occurred while update the book'
            ]);
        }
    }

    public function deleteBook($id)
    {
        try {
            $bookModel = new BookModel();
            $book = $bookModel->find($id);

            if (!$book) {
                return $this->response->setStatusCode(404)->setJSON([
                    'message' => 'Book not found'
                ]);
            }

            $bookModel->delete($id);

            return $this->response->setJSON(['message' => 'Book deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'message' => 'An error occurred while deleting the book'
            ]);
        }
    }
}
