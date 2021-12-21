<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $is_super
 * @property string|null $description
 * @property string $posted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsSuper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePostedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Te7aHoudini\LaravelTrix\Models\TrixAttachment[] $trixAttachments
 * @property-read int|null $trix_attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Te7aHoudini\LaravelTrix\Models\TrixRichText[] $trixRichText
 * @property-read int|null $trix_rich_text_count
 * @method static Builder|Article filter(array $frd)
 */
class Article extends Model
{
    use HasFactory, HasTrixRichText;

    protected $table = 'articles';
    protected $fillable = [
        'name',
        'slug',
        'is_super',
        'description',
        'posted_at',
        'article-trixFields',
    ];
    protected $casts = [
        'is_super' => 'bool',
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

    public function isSuper(): bool
    {
        return $this->is_super;
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return int
     */
    public function getIsSuper(): int
    {
        return $this->is_super;
    }

    /**
     * @param int $is_super
     */
    public function setIsSuper(int $is_super): void
    {
        $this->is_super = $is_super;
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
     * @return string
     */
    public function getPostedAt(): string
    {
        return $this->posted_at;
    }

    /**
     * @param string $posted_at
     */
    public function setPostedAt(string $posted_at): void
    {
        $this->posted_at = $posted_at;
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
