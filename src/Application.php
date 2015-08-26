<?php
namespace App;

use Silex\Application as BaseApplication;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use EmanueleMinotto\FakerServiceProvider\FakerServiceProvider;


class Application extends BaseApplication
{
    public function __construct(array $values = [])
    {
        parent::__construct($values);

        // routing
        $this['routes'] = $this->extend('routes', function (RouteCollection $routes) {
            $loader = new YamlFileLoader(new FileLocator(__DIR__ . '/../config'));
            $collection = $loader->load('routes.yml');
            $routes->addCollection($collection);

            return $routes;
        });
        // faker
        $this->register(new FakerServiceProvider(), [
            'faker.providers' => [
                'CompanyNameGenerator\\FakerProvider',
                'EmanueleMinotto\\Faker\\PlaceholdItProvider',
            ],
            'locale' => 'en_US',
        ]);
    }

    public function boot()
    {
        parent::boot();
        // faker extension
        $this['faker']->addProvider(new \App\Faker\AppFaker($this['faker']));
    }
}
