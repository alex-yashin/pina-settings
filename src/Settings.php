<?php

namespace PinaSettings;

use PinaSettings\SQL\SettingsGateway;

class Settings
{

    public static function get(string $name, string $default = '')
    {
        static $data = null;

        if (is_null($data)) {
            $data = SettingsGateway::instance()->first();
        }

        return $data[$name] ?? $default;
    }

}