<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author_id',
        'rating',
    ];

    protected $attributes = [
        'rating' => 0.0,
        'votes_amount' => 0,
    ];

    /**
     * @param string      $value
     * @param string|null $sort
     * @param string|null $sort_mode
     * @return array
     */
    public function fulltextSearchByBookOrAuthor(string $value, array $params = []): array
    {
        $offset = !empty($params['offset']) ? $params['offset'] : null;
        $limit = !empty($params['limit']) ? $params['limit'] : 10;

        $matchSection = "MATCH (books.title) AGAINST ('$value' IN BOOLEAN MODE)
            OR MATCH (authors.name) AGAINST ('$value' IN BOOLEAN MODE)";

        $qb = $this->select('books.*')
            ->rightJoin('authors', 'authors.id', '=', 'books.author_id')
            ->whereRaw($matchSection);

        $result = [
            'total' => $qb->count(),
        ];

        $sort = !empty($params['sort']) ? $params['sort'] : 'id';
        $sort_mode = !empty($params['sort_mode']) ? $params['sort_mode'] : null;

        if ($sort_mode === 'desc') {
            $result['books'] = $qb->orderBy($sort, 'desc')->offset($offset)->limit($limit)->get();
        } else {
            $result['books'] = $qb->orderBy($sort)->offset($offset)->limit($limit)->get();
        }

        return $result;
    }
}
