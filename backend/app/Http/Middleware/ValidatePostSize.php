<?php

namespace Illuminate\Foundation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\PostTooLargeException;

class ValidatePostSize
{
    /**
     * Lidar com uma requisição recebida.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Http\Exceptions\PostTooLargeException
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o tamanho do POST está dentro do limite do PHP
        if ($request->getContentLength() > $this->getPostMaxSize()) {
            throw new PostTooLargeException('O arquivo enviado excede o tamanho máximo permitido.');
        }

        return $next($request);
    }

    /**
     * Obter o tamanho máximo permitido para o post, em bytes.
     *
     * @return int
     */
    protected function getPostMaxSize()
    {
        // Retorna o valor do post_max_size em bytes, a partir da configuração PHP
        return $this->convertToBytes(ini_get('post_max_size'));
    }

    /**
     * Converter uma configuração PHP de tamanho (como '8M') para bytes.
     *
     * @param  string  $value
     * @return int
     */
    protected function convertToBytes($value)
    {
        $value = trim($value);
        $last = strtolower($value[strlen($value) - 1]);

        // Verifica a unidade (M, G, etc.) e converte para bytes
        switch ($last) {
            case 'g':
                $value *= 1024;
            case 'm':
                $value *= 1024;
            case 'k':
                $value *= 1024;
        }

        return $value;
    }
}
