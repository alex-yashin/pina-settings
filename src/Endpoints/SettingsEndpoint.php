<?php

namespace PinaSettings\Endpoints;

use Pina\Http\RichEndpoint;
use Pina\Response;

use PinaSettings\SQL\SettingsGateway;

use function Pina\__;

class SettingsEndpoint extends RichEndpoint
{

    public function title()
    {
        return __('Настройки');
    }

    public function index()
    {
        $this->makeCollectionComposer($this->title())->index($this->location());

        $record = $this->makeQuery()->firstDataRecord();

        return $this->resolveRecordView($record)->wrap($this->makeSidebarWrapper());
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function update()
    {
        $data = $this->request()->all();

        $normalized = $this->getSchema()->normalize($data);

        $this->makeQuery()->update($normalized);

        return Response::ok()->contentLocation($this->base()->link('@'));
    }

    /**
     * @return \Pina\Data\Schema
     * @throws \Exception
     */
    protected function getSchema()
    {
        return $this->makeQuery()->getSchema();
    }

    protected function makeQuery()
    {
        return SettingsGateway::instance();
    }

}
