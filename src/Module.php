<?php

namespace PinaSettings;

use Pina\App;
use Pina\ModuleInterface;
use PinaSettings\Endpoints\SettingsEndpoint;
use PinaSettings\Menu\SettingsMenu;
use Pina\Menu\MainMenu;

class Module implements ModuleInterface
{

    public function getPath()
    {
        return __DIR__;
    }

    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getTitle()
    {
        return 'Settings';
    }

    public function http()
    {
        /** @var SettingsMenu $settingsMenu */
        $settingsMenu = App::load(SettingsMenu::class);

        /** @var MainMenu $mainMenu */
        $mainMenu = App::load(MainMenu::class);

        App::router()->register('settings', SettingsEndpoint::class)->permit('root')
            ->addTag('settings')
            ->addToMenu($settingsMenu)
            ->addToMenu($mainMenu)
        ;

        return [];
    }

}
