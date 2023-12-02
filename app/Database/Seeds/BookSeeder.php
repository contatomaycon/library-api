<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\BookModel;

class BookSeeder extends Seeder
{
    public function run()
    {
        $bookModel = new BookModel();

        $books = [
            [
                'title'     => 'As Crônicas de Nárnia - Coleção de Luxo: Príncipe Caspian',
                'description' => 'Este é o segundo livro da série de C.S. Lewis, um dos maiores clássico da literatura infantojuvenil.',
                'author' => 'C.S. Lewis',
                'pages' => 224
            ],
            [
                'title' => 'O Senhor dos Anéis',
                'description' => 'Uma obra de ficção fantástica do autor britânico J.R.R. Tolkien. Considerado um dos maiores clássicos da literatura moderna.',
                'author' => 'J.R.R. Tolkien',
                'pages' => 1178
            ],
            [
                'title' => '1984',
                'description' => 'Romance distópico clássico de George Orwell.',
                'author' => 'George Orwell',
                'pages' => 328
            ],
            [
                'title' => 'O Grande Gatsby',
                'description' => 'Um retrato da Era do Jazz nos Estados Unidos, por F. Scott Fitzgerald.',
                'author' => 'F. Scott Fitzgerald',
                'pages' => 180
            ],
            [
                'title' => 'Para Matar um Mockingbird',
                'description' => 'Um clássico da literatura americana por Harper Lee.',
                'author' => 'Harper Lee',
                'pages' => 281
            ],
            [
                'title' => 'Orgulho e Preconceito',
                'description' => 'Romance de Jane Austen sobre moralidade e casamento na sociedade britânica do século XIX.',
                'author' => 'Jane Austen',
                'pages' => 432
            ],
            [
                'title' => 'O Sol é Para Todos',
                'description' => 'Obra-prima de Harper Lee explorando o racismo e a injustiça.',
                'author' => 'Harper Lee',
                'pages' => 296
            ],
            [
                'title' => 'A Revolução dos Bichos',
                'description' => 'Fábula distópica e crítica política de George Orwell.',
                'author' => 'George Orwell',
                'pages' => 112
            ],
            [
                'title' => 'O Apanhador no Campo de Centeio',
                'description' => 'Romance icônico de J.D. Salinger.',
                'author' => 'J.D. Salinger',
                'pages' => 277
            ],
            [
                'title' => 'O Alquimista',
                'description' => 'História inspiradora de Paulo Coelho sobre seguir seus sonhos.',
                'author' => 'Paulo Coelho',
                'pages' => 208
            ],
            [
                'title' => 'Cem Anos de Solidão',
                'description' => 'Épico de Gabriel García Márquez, uma obra-prima do realismo mágico.',
                'author' => 'Gabriel García Márquez',
                'pages' => 417
            ],
            [
                'title' => 'Crime e Castigo',
                'description' => 'Exploração psicológica de Dostoiévski sobre moralidade e redenção.',
                'author' => 'Fyodor Dostoevsky',
                'pages' => 671
            ],
            [
                'title' => 'O Senhor das Moscas',
                'description' => 'Romance de William Golding sobre a natureza humana.',
                'author' => 'William Golding',
                'pages' => 224
            ],
            [
                'title' => 'Moby Dick',
                'description' => 'A saga épica de Herman Melville no mar.',
                'author' => 'Herman Melville',
                'pages' => 720
            ],
            [
                'title' => 'Lolita',
                'description' => 'Polêmico romance de Vladimir Nabokov.',
                'author' => 'Vladimir Nabokov',
                'pages' => 331
            ],
            [
                'title' => 'A Divina Comédia',
                'description' => 'Obra-prima épica de Dante Alighieri.',
                'author' => 'Dante Alighieri',
                'pages' => 798
            ],
            [
                'title' => 'Guerra e Paz',
                'description' => 'Épico histórico de Leo Tolstoy sobre a sociedade russa.',
                'author' => 'Leo Tolstoy',
                'pages' => 1225
            ],
            [
                'title' => 'Frankenstein',
                'description' => 'Romance gótico de Mary Shelley.',
                'author' => 'Mary Shelley',
                'pages' => 280
            ],
            [
                'title' => 'Jane Eyre',
                'description' => 'Romance clássico de Charlotte Brontë.',
                'author' => 'Charlotte Brontë',
                'pages' => 500
            ],
            [
                'title' => 'Fahrenheit 451',
                'description' => 'Distopia futurista de Ray Bradbury.',
                'author' => 'Ray Bradbury',
                'pages' => 249
            ],
            [
                'title' => 'A Metamorfose',
                'description' => 'Novela existencial de Franz Kafka.',
                'author' => 'Franz Kafka',
                'pages' => 201
            ],
            [
                'title' => 'O Estrangeiro',
                'description' => 'Romance filosófico de Albert Camus.',
                'author' => 'Albert Camus',
                'pages' => 123
            ]
        ];

        $bookModel->insertBatch($books);
    }
}
