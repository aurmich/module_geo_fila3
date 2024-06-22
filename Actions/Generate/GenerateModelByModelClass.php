<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Generate;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Xot\Actions\Class\GetFilenameByClassnameAction;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GenerateModelByModelClass
{
    use QueueableAction;

    public array $replaces = [];

    /**
     * Execute the function with the given model class.
     *
     * @param string $model_class the class name of the model
     *
     * @return void
     */
    public function execute(string $model_class)
    {
        $this->generate($model_class);
        $filename = app(GetFilenameByClassnameAction::class)->execute($model_class);

        $content_old = File::get($filename);
        $content = $content_old;
        foreach ($this->replaces as $k => $v) {
            if (method_exists($this, 'replace'.$k)) {
                $content = $this->{'replace'.$k}($v, $content);
            }
            // $content=$this->replace($content,$k,$v);
        }
        $content = str_replace(' extends Model', ' extends BaseModel', $content);
        $content = str_replace('use HasFactory;', '', $content);
        Assert::string($content, '['.__LINE__.']['.__FILE__.']');

        if ($content != $content_old) {
            File::put($filename, $content);
        }
    }

    public function replaceDummyTable(string $value, string $content): string
    {
        $table_start = strpos($content, 'protected $table');
        Assert::integer($fillable_start = strpos($content, 'protected $fillable'), '['.__LINE__.']['.__FILE__.']');
        $fillable_end = strpos($content, '];', $fillable_start);
        if (false === $table_start) {
            $before = substr($content, 0, $fillable_end + 2);
            $after = substr($content, $fillable_end + 2);
            $content = $before.PHP_EOL.'    protected $table = "'.$value.'";'.PHP_EOL.$after;
        }

        return $content;
    }

    /**
     * Create a factory for the given model class.
     *
     * @param string $model_class The class name of the model to create the factory for
     *
     * @return void
     */
    public function generate(string $model_class)
    {
        $model_name = class_basename($model_class);
        $module_name = Str::of($model_class)->between('Modules\\', '\Models\\')->toString();
        $artisan_cmd = 'module:make-model';
        $artisan_params = ['model' => $model_name, 'module' => $module_name];
        $res = Artisan::call($artisan_cmd, $artisan_params);
        /*
        $output=Artisan::output();

        dddx(
            [
                'res'=>$res,
                'output'=>$output,
                'model_name'=>$model_name,
                'module_name'=>$module_name,
                'artisan_cmd'=>$artisan_cmd,
                'artisan_params'=>$artisan_params,
            ]
        );
        */
    }

    public function setCustomReplaces(array $replaces): self
    {
        $this->replaces = array_merge($this->replaces, $replaces);

        return $this;
    }
}
