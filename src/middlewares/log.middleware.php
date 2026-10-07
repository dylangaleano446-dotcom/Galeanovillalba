<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;

function logMiddleware(Request $request, RequestHandler $handler): Response {
    $startTime = microtime(true);

    $response = $handler->handle($request);

    $executionTime = round((microtime(true) - $startTime) * 1000, 2);

    $dateTime = date('Y-m-d H:i:s');
    $method = $request->getMethod();
    $uri = $request->getUri()->getPath();
    $status = $response->getStatusCode();

    $logLine = "[$dateTime] $method $uri - Estado: $status - Tiempo: {$executionTime}ms" . PHP_EOL;

    echo $logLine;
    file_put_contents(__DIR__ . '/../../app.log', $logLine, FILE_APPEND);

    return $response;
}
