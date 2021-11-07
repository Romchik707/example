<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * App\Models\ProductCategory
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $parent_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereParentCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ProductCategory|null $parentCategory
 * @property-read \App\Models\ProductCategory|null $childCategories
 * @property-read int|null $child_categories_count
 */
class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_category_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentCategory(): HasOne
    {
        return $this->hasOne(ProductCategory::class, 'id', 'parent_category_id');
    }

    /**
     * @return ProductCategory
     */
    public function getParentCategory(): ?ProductCategory
    {
        return $this->parentCategory;
    }

    /**
     * @return string|null
     */
    public function getParentCategoryName(): ?string
    {
        $parentCategoryName = null;
        $parentCategory = $this->getParentCategory();
        if ($parentCategory !== null) {
            $parentCategoryName = $parentCategory->getName();
        }
        return $parentCategoryName;
    }

    /**
     * @return Collection
     */
    public function getCategoriesWithoutSelf(): Collection
    {
        $categories = ProductCategory::whereNotIn('id', [$this->getKey()])->get();
        return $categories;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductCategory::class, 'id');
    }

    /**
     * @return ProductCategory
     */
    public function getChildCategories(): ProductCategory
    {
        return $this->childCategories;
    }

    /**
     * @return array
     */
    public static function getList(): array
    {
        return self::pluck('name', 'id')->toArray();
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
     * @return int|null
     */
    public function getParentCategoryId(): ?int
    {
        return $this->parent_category_id;
    }

    /**
     * @param int|null $parent_category_id
     */
    public function setParentCategoryId(?int $parent_category_id): void
    {
        $this->parent_category_id = $parent_category_id;
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
