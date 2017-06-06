<?php

namespace Availy\Application;

use Polymorph\Application\ApplicationController as PolymorphApplicationController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Availy Application Controller
 *
 */
class ApplicationController extends PolymorphApplicationController
{

    /**
     * Serves allocation definitions
     *
     * @param object $routeOptions
     * @return JsonResponse
     */
    public function handleAllocationsRequest($routeOptions)
    {
        $response = [];
        foreach ($routeOptions->files as $path) {
            $data = json_decode(file_get_contents(POLYMORPH_APP_DIR . $path), true);
            $response = array_merge($response, $data);
        }
        return new JsonResponse($response);
    }
}
