<?php


function moduleManager($config)
{
    include_once $config;
    



    $globalConfig=array();
    $localConfig=array();
      
    foreach($config['modules'] as $module)
    {   
        $globalFile = __DIR__.'/../../../../../configs/autoload/'.strtolower($module).'.global.php';

        if(file_exists($globalFile))
        {
            include_once $globalFile;
            $globalConfig = $config;
        }
        
        $localFile = __DIR__.'/../../../../../configs/autoload/'.strtolower($module).'.local.php';
        if(file_exists($localFile))
        {
            include_once $localFile;
            $localConfig = $config;
        }
        $config = array_replace_recursive($config, $globalConfig, $localConfig);
    }   
        
    return $config;
}