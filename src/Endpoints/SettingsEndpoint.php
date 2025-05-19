<?php

namespace PinaSettings\Endpoints;

use Pina\App;
use Pina\Composers\CollectionComposer;
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
        /** @var CollectionComposer $composer */
        $composer = App::make(CollectionComposer::class);
        $composer->configure($this->title(), '');
        $composer->index($this->location);

        $record = $this->makeQuery()->firstDataRecord();

        return $this->resolveRecordView($record)->wrap($this->makeSidebarWrapper());
    }

    public function update()
    {
        $data = $this->request()->all();

        $normalized = $this->getSchema()->normalize($data);

        $this->makeQuery()->update($normalized);

        return Response::ok()->contentLocation($this->base->link('@'));
    }

    protected function getSchema()
    {
        return $this->makeQuery()->getSchema();
    }

    protected function makeQuery()
    {
        return SettingsGateway::instance();
    }

}
