<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Laratrust\Models\LaratrustPermission;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static Builder|Permission filter(array $frd)
 */
class Permission extends LaratrustPermission
{
    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public $guarded = [];

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
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->display_name;
    }

    /**
     * @param string|null $display_name
     */
    public function setDisplayName(?string $display_name): void
    {
        $this->display_name = $display_name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->created_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->updated_at;
    }

    /**
     * @return Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
