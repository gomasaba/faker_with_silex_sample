<?php
namespace App\Controller;

use App\Application as Application;
use Symfony\Component\HttpFoundation\Request as Request;

class UsersController
{

    public function detail(Application $app, Request $request)
    {
        $data = [
            "id" => $request->get('user_id'),
            "username" => $app['faker']->name,
            "full_name" => $app['faker']->name,
            "profile_picture" => $app['faker']->profilePicture,
            "bio" => $app['faker']->realText(rand(10, 20)),
            "website" => $app['faker']->url,
            "counts" => [
                "media" => $app['faker']->numberBetween(0, 10000),
                "follows" => $app['faker']->numberBetween(0, 1000),
                "followed_by" => $app['faker']->numberBetween(0, 10000),
            ]
        ];

        return $app->json(['data' => $data]);
    }

    public function search(Application $app, Request $request)
    {
        $data = [];
        for ($i = 1; $i <= rand(0, 100); $i++) {
            $row = [
                'username' => $app['faker']->bothify($request->get('q') . '##??'),
                'first_name' => $app['faker']->firstName,
                'profile_picture' => $app['faker']->profilePicture,
                'id' => $app['faker']->numberBetween(1, 10000),
                'last_name' => $app['faker']->lastName,
            ];
            array_push($data, $row);
        }

        return $app->json($data);
    }
}
