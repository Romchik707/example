<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User orWherePermissionIs($permission = '')
 * @method static \Illuminate\Database\Eloquent\Builder|User orWhereRoleIs($role = '', $team = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDoesntHavePermission()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDoesntHaveRole()
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePermissionIs($permission = '', $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleIs($role = '', $team = null, $boolean = 'and')
 */
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param Builder $query
     * @param array $frd
     * @return Builder
     */
    //как вы видите она принимает
    //query - поскольку эта функция волшебная, query она создает сама, при вызове не указываем
    // по сути query это запрос к вашей модели, ко всем записям из таблицы и уже к этому запросу мы пишем
    // подзапросики
    //frd - переменные с формы, это уже надо передавать при вызове функции
    public function scopeFilter(Builder $query, array $frd): Builder
    {
        //тут мы выполняем код для всех переменных в frd, стандартный foreach, кто не знает почитать
        foreach ($frd as $key => $value) {
            //если значение в frd равно null, игнорируем код дальше и переходим к новому значению frd
            if (null === $value) {
                continue;//continue игнорирует код ниже
            }
            switch ($key) {
                case 'search':
                    //если ключь в frd равен search, кто не знает switch case конструкцию в гугл быстро )
                    {
                        //вызываем запрос внутри запроса, по сути можно и просто то, что после return написать
                        //и будет работать, но так как тут правильнее
                        $query->where(static function (Builder $query) use ($value): Builder {
                            //у вас есть операторы =, >, <, а есть like, для поиска записи по совпадениям
                            //ну вы и пишете что поле name должно содержать в себе строку со значением value
                            //знак % - показывает, что искомая строка может быть в любой части поля
                            //например название продукта "самокат синий" - если value %мокат% например, то
                            //он найдет совпадение
                            return $query->where('name', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }

        return $query;
    }

    /**
     * @return string
     */
    public function getRememberTokenName(): string
    {
        return $this->rememberTokenName;
    }

    /**
     * @param string $rememberTokenName
     */
    public function setRememberTokenName(string $rememberTokenName): void
    {
        $this->rememberTokenName = $rememberTokenName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->created_at;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

}
