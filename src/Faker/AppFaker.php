<?php
namespace App\Faker;

class AppFaker extends \Faker\Provider\Base
{

    public function profilePicture()
    {
        $url = 'http://distillery.s3.amazonaws.com/profiles/profile_';
        return $url . $this->generator->uuid . '.jpg';
    }

}
