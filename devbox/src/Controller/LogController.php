<?php

namespace App\Controller;

use App\Actions\FilterLog;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LogController extends AbstractController
{
    /**
     * @param Request $request
     * @param FilterLog $filterLog
     * @return JsonResponse
     */
    #[Route('/count', name: 'app_log', methods: 'GET')]
    public function index(Request $request, FilterLog $filterLog): JsonResponse
    {
        try {
            if(empty($request->query->all()))  throw new Exception('Requests are empty', 422);
            if(!is_array($request->query->get('serviceNames')))  throw new Exception('serviceNames name is invalid', 422);

             $filterLog->run($request->toArray());
            return new JsonResponse(['counter' => 1]);
        }catch (Exception $exception){
            return $this->json([
                'status' => 'failed',
                'message' => $exception->getMessage()
            ]);
        }
    }
}
