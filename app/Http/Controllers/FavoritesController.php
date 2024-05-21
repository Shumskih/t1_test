<?php

namespace App\Http\Controllers;

use Exception;
use App\Web\Request;
use App\Web\Response;
use App\Tools\Helper as CleanHelper;
use App\Repository\Favorites\Helper;

class FavoritesController
{
    /**
     * @throws Exception
     */
    public function index(Request $request, Response $response): false|string
    {
        $storeService = (new Helper())->getService();
        $data = $storeService->getAll();

        $response->setStatus(200);

        return $response->json(['status' => 'success', 'elements' => $data]);
    }

    /**
     * @throws Exception
     */
    public function store(Request $request, Response $response): false|string
    {
        $helper = new CleanHelper();
        $storeService = (new Helper())->getService();

        $values = $request->getJson();

        $id = (int)$values['id'];

        if ($storeService->exists($id)) {
            throw new Exception('Эта новость уже в избранном! (id: ' . $id . ')', 400);
        }

        $title = $helper->cleanData($values['title']);
        $category = $helper->cleanData($values['category']);

        if (empty($title) || empty($category)) {
            throw new Exception('Переданы пустые данные для сохранения!');
        }

        $result = $storeService->save($id, $title, $category);
        if (!$result) {
            throw new Exception('Не удалось добавить в избранное!');
        }

        $response->setStatus(200);

        return $response->json([
            'status' => 'success',
            'message' => 'Добавлено в избранное (id: ' . $values['id'] . ')',
        ]);
    }

    /**
     * @throws Exception
     */
    public function remove(Request $request, Response $response, int $id): false|string
    {
        (new Helper())->getService()->delete($id);
        $response->setStatus(200);

        return $response->json(['status' => 'success', 'data' => $id]);
    }
}
