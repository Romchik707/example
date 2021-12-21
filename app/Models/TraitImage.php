<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\TraitImage
 *
 * @property int $id
 * @property string $alt
 * @property string $title
 * @property string $url
 * @property string $description
 * @property int $size
 * @property int $imageable_id
 * @property string $imageable_type
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|TraitImage filter(array $frd)
 * @method static Builder|TraitImage newModelQuery()
 * @method static Builder|TraitImage newQuery()
 * @method static Builder|TraitImage query()
 * @method static Builder|TraitImage whereAlt($value)
 * @method static Builder|TraitImage whereCreatedAt($value)
 * @method static Builder|TraitImage whereDescription($value)
 * @method static Builder|TraitImage whereId($value)
 * @method static Builder|TraitImage whereImageableId($value)
 * @method static Builder|TraitImage whereImageableType($value)
 * @method static Builder|TraitImage whereSize($value)
 * @method static Builder|TraitImage whereTitle($value)
 * @method static Builder|TraitImage whereUpdatedAt($value)
 * @method static Builder|TraitImage whereUrl($value)
 * @method static Builder|TraitImage whereUserId($value)
 * @mixin \Eloquent
 */
class TraitImage extends Model
{
    use HasFactory;

    protected $table = 'trait_images';

    protected $fillable = ['alt', 'title', 'url', 'description', 'size',
                           'imageable_id', 'imageable_type', 'user_id'];

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
                            return $query->where('title', 'like', '%' . $value . '%');
                        });
                    }
                    break;
            }
        }

        return $query;
    }

    /**
     * @return bool|string[]
     */
    public function getGuarded()
    {
        return $this->guarded;
    }

    /**
     * @param bool|string[] $guarded
     */
    public function setGuarded($guarded): void
    {
        $this->guarded = $guarded;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getImageableId(): int
    {
        return $this->imageable_id;
    }

    /**
     * @param int $imageable_id
     */
    public function setImageableId(int $imageable_id): void
    {
        $this->imageable_id = $imageable_id;
    }

    /**
     * @return string
     */
    public function getImageableType(): string
    {
        return $this->imageable_type;
    }

    /**
     * @param string $imageable_type
     */
    public function setImageableType(string $imageable_type): void
    {
        $this->imageable_type = $imageable_type;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
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
