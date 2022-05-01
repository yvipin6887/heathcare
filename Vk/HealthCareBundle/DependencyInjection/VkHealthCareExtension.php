<?php
namespace App\Vk\HealthCareBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class VkHealthCareExtension extends Extension{

    public function load(array $config,ContainerBuilder $conatiner){
        $loader =new YamlFileLoader($conatiner, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('controller.yml');
        $loader->load('validator/validation.yml');
       
    }

}