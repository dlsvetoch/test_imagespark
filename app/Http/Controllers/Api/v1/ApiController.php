<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Traits\MathTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    use MathTrait;

    /**
     * @param $result
     * @param $message
     * @param $code
     * @return JsonResponse
     */
    public function sendResponse($result, $message, $code): JsonResponse
    {

        return response()->json($this->makeResponse($message, $result), $code);
    }

    /**
     * @param $error
     * @param int $code
     * @param array $data
     * @return mixed
     */
    public function sendError($error, int $code = 400, array $data = []): JsonResponse
    {

        return response()->json($this->makeError($error, $data), $code);
    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    protected function makeResponse(string $message, array $data): array
    {
        return [
            'message' => $message,
            'data'    => $data,
        ];
    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    protected static function makeError(string $message, array $data = []): array
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }

    /**
     * Get items by request and model
     *
     * @param Request $request
     * @param Model $model
     * @return array
     */
    protected function getItemsByRequest(Request $request, Model $model): Array
    {
        $offset = $request->get('offset') ?? 0;
        $limit = $request->get('limit') ?? 10;
        $sort = $request->get('sort') ?: 'id';

        $result = [
            'total' => $model->count(),
        ];

        if ($request->get('sort_mode') === 'desc') {
            $result[$model->getTable()] = $model->orderBy($sort, 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();
        } else {
            $result[$model->getTable()] = $model->orderBy($sort)
                ->offset($offset)
                ->limit($limit)
                ->get();
        }

        return $result;
    }

    /**
     * Set rating for model
     *
     * @param Request $request
     * @param Model $model
     * @return Model
     */
    protected function setRating(Request $request, Model $model)
    {
        $parameters = $request->all();

        $model->votes_amount = $model->votes_amount + 1;
        $parameters['rating'] = $this->average($model->rating, $parameters['rating'], $model->votes_amount);

        $model->update($parameters);

        return $model;
    }
}
