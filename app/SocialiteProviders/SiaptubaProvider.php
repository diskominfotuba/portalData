<?php

namespace App\SocialiteProviders;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;
use Illuminate\Support\Str;


class SiaptubaProvider extends AbstractProvider
{
    protected $scopes = [];

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('services.siaptuba.base_uri') . '/oauth/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return config('services.siaptuba.base_uri') . '/oauth/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(config('services.siaptuba.base_uri') . '/api/sso/user', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'name' => $user['nama'],
            'email' => $user['email'],
        ]);
    }
}
