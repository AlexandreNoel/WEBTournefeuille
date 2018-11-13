<?php
namespace Token;

class JwtHS256
{
    public static function generate($user, string $secret, int $exp)
    {
        $header = Base64Url::encode(json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]));
        $payload = Base64Url::encode(json_encode([
            'user' => [
                'id' => $user->getId(),
                'role' => $user->getRole()
            ],
            'exp' => $exp
        ]));
        $signature = Base64Url::encode(
            hash_hmac('sha256', $header . '.' . $payload, $secret, true)
        );

        return $header . '.' . $payload . '.' . $signature;
    }

    public static function validate(string $token, string $secret)
    {
        [$header, $payload, $signature] = explode('.', $token);

        $signatureValidation = Base64Url::encode(
            hash_hmac('sha256', $header . '.' . $payload, $secret, true)
        );
        if (strcmp($signatureValidation, $signature) !== 0) {
            throw new \Exception('Token is corrupted');
        }

        $json = json_decode(Base64Url::decode($payload));
        if ($json->exp < time()) {
            throw new \Exception('Token has expired');
        }

        return $json->user;
    }
}
