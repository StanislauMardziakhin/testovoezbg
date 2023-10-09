<?php


namespace App\Http\Services;


use Illuminate\Support\Arr;

class TokenValidationService
{
    /**
     * check if sig is valid
     *
     * @param array $requestData
     * @return bool
     */
    public function isValid(array $requestData): bool
    {
        $sig = Arr::get($requestData,'sig');
        $requestData = Arr::except($requestData, ['sig']);
        ksort($requestData);
        $str = '';
        foreach ($requestData as $key => $value) {
            $tmpString = $key . '=' . $value;
            $str .= $tmpString;
        }
        $str .= config('app.secret_key');
        $generatedKey = mb_strtolower(md5($str), 'UTF-8');
        return $generatedKey === $sig;
    }
}
