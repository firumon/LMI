<?php

namespace Firumon\LMI;

use Illuminate\Support\ServiceProvider;

class LMIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->loadConfigs();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutes();
        $this->loadViews();
        //$this->loadMigrations();
        //$this->registerEvents();
    }

    private function stripSlashes($text){ return trim($text,"\\\/"); }
    private function getRootPath(){ return __DIR__ . '/..'; }
    private function getFullPath($folder){ return implode('/',[$this->stripSlashes($this->getRootPath()),$this->stripSlashes($folder),""]); }
    private function getProjectMigrationPath(){ return $this->getFullPath('migrations'); }
    private function getProjectConfigFilePath($file){ return $this->getFullPath('config') . $file; }
    private function getProjectRoutesPath(){ return $this->getFullPath('routes') . 'web.php'; }
    private function getProjectViewsPath(){ return $this->getFullPath('views'); }

    private function loadRoutes(){
        $source = $this->getProjectRoutesPath();
        $this->loadRoutesFrom($source);
    }

    private function loadViews(){
        $source = $this->getProjectViewsPath();
        $this->loadViewsFrom($source,'lmi');
    }

    private function loadMigrations(){
        $source = $this->getProjectMigrationPath();
        $this->loadMigrationsFrom($source);
    }

    private function registerEvents(){
        Events::Register();
    }

    private function loadConfigs(){
        $this->mergeConfigFrom($this->getProjectConfigFilePath('filesystems.disks.php'),'filesystems.disks.llm');
    }
}
