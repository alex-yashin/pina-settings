<?php

namespace PinaSettings;

use Pina\InstallationInterface;
use PinaSettings\SQL\SettingsGateway;

class Installation implements InstallationInterface
{
    /**
     * @throws \Exception
     */
    public function install()
    {
        if (!SettingsGateway::instance()->exists()) {
            SettingsGateway::instance()->insertIgnore(['updated_at' => date('Y-m-d H:i:s')]);
        }
    }

    public function prepare()
    {
    }

    public function remove()
    {
    }
}