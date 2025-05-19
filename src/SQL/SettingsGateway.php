<?php

namespace PinaSettings\SQL;

use Pina\Data\Schema;
use Pina\TableDataGateway;

class SettingsGateway extends TableDataGateway
{
    protected static $table = 'settings';

    public function getSchema(): Schema
    {
        $schema = parent::getSchema();
        $schema->addUpdatedAt()->setStatic()->setHidden();
        return $schema;
    }

}
