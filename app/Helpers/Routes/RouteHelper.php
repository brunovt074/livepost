<?php

namespace App\Helpers\Routes;

class RouteHelper
{
    public static function includeRouteFiles(string $folder)
    {
        //The directory iterator could help us to load our routes in a folder.
        //iterate thru the v1 folder recursively
        $dirIterator = new \RecursiveDirectoryIterator($folder);
        
        /** @var \RecursiveDirectoryIterator | \RecursiveIteratorIterator $it */
        $it = new \RecursiveIteratorIterator($dirIterator);

        //require the file in each iteration
        while($it->valid()){
            if(!$it->isDot()//inside child folder
                && $it->isFile()
                && $it->isReadable()
                && $it->current()->getExtension() === 'php')
            {
                require $it->key();//obtain the path
                
                //other way to do the same
                //require $it->current()->getPathname();
            }
            $it->next();   
        }       
        
    }    

}