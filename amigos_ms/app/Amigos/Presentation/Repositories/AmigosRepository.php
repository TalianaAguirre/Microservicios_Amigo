<?php

namespace App\Amigos\Presentation\Repositories;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Amigos\Controllers\AmigosController;
use Exception;

class AmigosRepository
{

    function all(Request $request, Response $response)
    {
        $controller = new AmigosController();
        $amigos = $controller->getAmigos();
        $response->getBody()->write($amigos);
        return $response->withHeader("Content-Type", "application/json");
    }

    function create(Request $request, Response $response)
    {
        $bodyRequest = $request->getBody()->getContents();
        $data = json_decode($bodyRequest, true);
        $controller = new AmigosController();
        $amigos = $controller->guardaramigos($data);
        $response->getBody()->write($amigos);
        return $response->withHeader("Content-Type", "application/json");
    }

    function detail(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];

            $controller = new AmigosController();
            $amigos = $controller->getAmigos($id);

            $resposeBody = $amigos->toJson();
            $resp->getBody()->write($resposeBody);
            return $resp->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 404;
            }
            return $resp->withStatus($code);
        }
    }

    function update(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];
            $body = $req->getBody()->getContents();
            $data = json_decode($body, true);

            $controller = new AmigosController();
            $amigos = $controller->modificarAmigos($id, $data);

            $dataResponse = $amigos->toJson();
            $resp->getBody()->write($dataResponse);
            return $resp
                ->withStatus(200)
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 404;
            }
            return $resp->withStatus($code);
        }
    }

    function delete(Request $req, Response $resp, $args)
    {
        try {
            $id = $args['id'];

            $controller = new AmigosController();
            $controller->borrarAmigos($id);

            $dataResponse = json_encode(['mgs' => 'Amigos borrado']);
            $resp->getBody()->write($dataResponse);
            return $resp
                ->withStatus(200)
                ->withHeader("Content-Type", "application/json");
        } catch (Exception $ex) {
            $resp->getBody()->write("Error: " . $ex->getMessage());
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 404;
            }
            return $resp->withStatus($code);
        }
    }
}