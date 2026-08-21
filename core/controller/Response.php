<?php

/**
 * Clase Response
 * 
 * Helper para emitir respuestas HTTP estructuradas, como JSON para APIs RESTful.
 */
class Response {
    /**
     * Emite una respuesta en formato JSON con la cabecera Content-Type adecuada
     * @param mixed $data Datos a serializar en JSON
     * @param int $statusCode Código de respuesta HTTP (ej. 200, 400, 404, 500)
     */
    public static function json($data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
