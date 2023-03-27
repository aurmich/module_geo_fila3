<?php

declare(strict_types=1);

namespace Modules\Media\Http\Livewire\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\Media\Traits\WithMedia;

class Crud extends Component {
    use WithMedia;

    public $name;

    public $model = null;

    public $mediaComponentNames = ['upload'];

    public $upload;

    public $collection;

    public function mount(string $name, Model $model, string $collection) {
        $this->name = $name;
        $this->model = $model;
        $this->collection = $collection;
    }

    public function submit() {
        $this->model
            ->addFromMediaLibraryRequest($this->upload)
            ->toMediaCollection($this->collection);
        session()->flash('message', 'Media successfully updated.');
        $this->clearMedia();

    }



    public function submit_AAA() {
        foreach ($this->upload as $attachment) {
            $disk = config('media-library.disk_name');
            $disk_url = Storage::disk($disk)->url('');
            $n = Str::between(str_replace(['\\', '/'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $attachment['previewUrl']), str_replace(['\\', '/'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $disk_url), DIRECTORY_SEPARATOR.'conversions');

            $path = Storage::disk($disk)->path($n.DIRECTORY_SEPARATOR.$attachment['fileName']);
            // dddx([
            //     'attachment' => $attachment,
            //     '$attachment previewUrl' => $attachment['previewUrl'],
            //     'n' => $n,
            //     'path' => $path,
            //     'this collection' => $this->collection,
            //     'model' => $this->model,
            // ]);
            // $url = storage_path('app/public'.Str::between($attachment['previewUrl'], 'storage', 'conversions').$attachment['name']);
            // $url = $disk['previewUrl']
            $this->model
                ->addMedia($path)
                ->toMediaCollection($this->collection);
        }

        session()->flash('message', 'Post successfully updated.');
    }

    public function render() {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute();

        return view($view);
    }
}