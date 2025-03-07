<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Wireable;
use Modules\Tenant\Services\TenantService;
use Modules\User\Contracts\TeamContract;
use Modules\User\Contracts\TenantContract;
use Modules\User\Models\Membership;
use Modules\User\Models\Team;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Contracts\UserContract;

use function Safe\realpath;

use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

/**
 * Class Modules\Xot\Datas\XotData.
 * ----.
 */
class XotData extends Data implements Wireable
{
    use WireableData;

    public string $main_module = '';

    public string $param_name = 'noset';

    public string $adm_home = '01';

    public ?string $adm_theme = ''; // ' => 'AdminLTE',

    // public bool $enable_ads;//' => '1',
    public string $primary_lang = 'it';

    public string $pub_theme;

    // ' => 'One',
    public string $search_action = 'it/videos';

    public bool $show_trans_key = false;

    public string $register_type = '0';

    public string $verification_type = '';

    public bool $login_verified = false;

    public bool $disable_frontend_dynamic_route = false;

    public bool $disable_admin_dynamic_route = false;

    public bool $disable_database_notifications = true;

    public bool $register_adm_theme = false;

    public bool $register_pub_theme = false;

    public bool $register_collective = false;

    public string $team_class = 'Modules\User\Models\Team'; // = Team::class;

    public string $tenant_class = 'Modules\User\Models\Tenant'; // = Team::class;

    public string $membership_class = 'Modules\User\Models\Membership'; // = Membership::class;

    public string $tenant_pivot_class = 'Modules\User\Models\TenantUser'; // = Membership::class;

    public ?string $super_admin = null;

    public string $video_player = 'html5';

    private static ?self $instance = null;

    /**
     * @var (ProfileContract)|null
     */
    private $profile;

    public static function make(): self
    {
        if (! self::$instance) {
            $data = TenantService::getConfig('xra');
            self::$instance = self::from($data);
        }

        return self::$instance;
    }

    public function isSuperAdmin(): bool
    {
        $profile = $this->getProfileModel();
        if ($profile->isSuperAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return class-string<Model&UserContract>
     */
    public function getUserClass(): string
    {
        $class = config('auth.providers.users.model');
        Assert::stringNotEmpty($class, 'check config auth');
        Assert::classExists($class, '['.$class.'] check config auth');
        Assert::implementsInterface($class, UserContract::class, 'class '.$class.' not implements UserContract['.__LINE__.']['.class_basename($this).']');
        Assert::isAOf($class, Model::class, '['.__LINE__.']['.class_basename($this).']['.$class.']');

        return $class;
    }

    /**
     * Ottiene un utente tramite email.
     *
     * @param string $email L'indirizzo email dell'utente
     * @return UserContract L'utente trovato o creato
     * @throws \InvalidArgumentException Se la classe utente non è configurata correttamente
     */
    public function getUserByEmail(string $email): UserContract
    {
        $userClass = $this->getUserClass();
        
        /** @var Model&UserContract $userInstance */
        $userInstance = new $userClass();
        
        if (! in_array('email', $userInstance->getFillable(), true)) {
            throw new \InvalidArgumentException(
                sprintf('Attributo email non trovato nei fillable del modello %s', get_class($userInstance))
            );
        }

        /** @var Model&UserContract $user */
        $user = $userClass::firstOrCreate(['email' => $email]);
        Assert::notNull($user, sprintf('Impossibile trovare o creare utente con email %s', $email));
        Assert::implementsInterface($user, UserContract::class);

        return $user;
    }

    /**
     * @return class-string<Model&TeamContract>
     */
    public function getTeamClass(): string
    {
        Assert::classExists($class = $this->team_class, '['.__LINE__.']['.class_basename($this).']');
        // Assert::isInstanceOf($team_class, Model::class, '['.__LINE__.']['.class_basename($this).']');
        Assert::isAOf($class, Model::class, '['.__LINE__.']['.class_basename($this).']['.$class.']');
        Assert::implementsInterface($class, TeamContract::class, '['.$class.']['.__LINE__.']['.class_basename($this).']');

        return $class;
    }

    /**
     * Undocumented function.
     *
     * @return class-string<Model&TenantContract>
     */
    public function getTenantClass(): string
    {
        Assert::classExists($class = $this->tenant_class, '['.$class.']['.__LINE__.']['.class_basename($this).']');
        // Assert::isInstanceOf($class, Model::class, '['.__LINE__.']['.class_basename($this).']');
        // Assert::isAOf($class, Model::class, '['.__LINE__.']['.class_basename($this).']['.$class.']');
        Assert::implementsInterface($class, TenantContract::class, '['.__LINE__.']['.class_basename($this).']');
        Assert::isAOf($class, Model::class, '['.__LINE__.']['.class_basename($this).']['.$class.']');

        return $class;
    }

    /**
     * @return class-string
     */
    public function getTenantResourceClass(): string
    {
        $class = Str::of($this->tenant_class)
            ->replace('\Models\\', '\Filament\Resources\\')
            ->append('Resource')
            ->toString();
        Assert::classExists($class, '['.$class.']['.__LINE__.']['.class_basename($this).']');

        return $class;
    }

    public function getTenantPivotClass(): string
    {
        $class = $this->tenant_pivot_class;
        Assert::classExists($class, '['.__LINE__.']['.class_basename($this).']');

        return $class;
    }

    public function getMembershipClass(): string
    {
        $class = $this->membership_class;
        Assert::classExists($class, '['.__LINE__.']['.class_basename($this).']');

        return $class;
    }

    /**
     * @return class-string<Model&ProfileContract>
     */
    public function getProfileClass(): string
    {
        $class = 'Modules\\'.$this->main_module.'\Models\Profile';
        // Assert::classExists($class, '['.$class.']['.__LINE__.']['.class_basename($this).']');
        // Assert::isInstanceOf($class, Model::class, '['.__LINE__.']['.class_basename($this).']['.$class.']');
        // Assert::isAOf($class, Model::class, '['.__LINE__.']['.class_basename($this).']['.$class.']');
        // Assert::implementsInterface($class, ProfileContract::class, '['.__LINE__.']['.class_basename($this).']['.$class.']');

        return $class;
    }

    public function getHomeController(): string
    {
        return 'Modules\\'.$this->main_module.'\Http\Controllers\HomeController';
    }

    public function getProfileModelByUserId(string $user_id): ProfileContract
    {
        $profileClass = $this->getProfileClass();
        /** @var Model&ProfileContract $profile */
        $profile = app($profileClass);

        Assert::isInstanceOf($profile, Model::class);
        Assert::isArray($profile->getFillable(), 'getFillable() must return array');

        if (! in_array('user_id', $profile->getFillable(), true)) {
            throw new \Exception('add user_id to fillable on class '.$profileClass);
        }

        /** @var ProfileContract */
        $res = $profile->firstOrCreate(['user_id' => $user_id]);
        Assert::implementsInterface($res, ProfileContract::class);

        return $res;
    }

    /**
     * Ottiene un profilo tramite email.
     *
     * @param string $email L'indirizzo email dell'utente
     * @return ProfileContract Il profilo associato all'utente
     * @throws \InvalidArgumentException Se l'utente non viene trovato
     */
    public function getProfileByEmail(string $email): ProfileContract
    {
        /** @var UserContract $user */
        $user = $this->getUserByEmail($email);
        Assert::notNull($user->getKey(), 'User ID non può essere null');
        
        /** @var ProfileContract $profile */
        $profile = $this->getProfileModelByUserId((string)$user->getKey());
        Assert::implementsInterface($profile, ProfileContract::class);

        return $profile;
    }

    /**
     * Verifica se l'utente corrente è un super admin.
     */
    public function iAmSuperAdmin(): bool
    {
        /** @var UserContract|null */
        $user = \Illuminate\Support\Facades\Auth::user();
        if (null === $user) {
            return false;
        }

        return $user instanceof UserContract && $user->hasRole('super-admin');
    }

    public function getProfileModel(): ProfileContract
    {
        if (null !== $this->profile) {
            return $this->profile;
        }
        $user_id = (string) authId();

        Assert::isInstanceOf($this->profile = $this->getProfileModelByUserId($user_id), ProfileContract::class, '['.__LINE__.']['.class_basename($this).']');

        return $this->profile;
    }

    public function update(array $data): self
    {
        foreach ($data as $k => $v) {
            $this->{$k} = $v;
        }

        // $this->save();
        return $this;
    }

    public function save(): void
    {
        dddx('wip');
    }

    public function getPubThemeViewPath(string $key = ''): string
    {
        $theme = $this->pub_theme;
        $path0 = base_path('Themes/'.$theme.'/resources/views/'.$key);
        try {
            $path = realpath($path0);
        } catch (\Exception $e) {
            throw new \Exception('realpath not find dir['.$path0.']'.PHP_EOL.'['.$e->getMessage().']');
        }

        return $path;
    }
}
