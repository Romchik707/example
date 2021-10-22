<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discord
 *
 * @property int $id
 * @property string $who_nah
 * @property string $where_nah
 * @property string $when_nah
 * @property string $how_nah
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discord query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereHowNah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereWhenNah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereWhereNah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discord whereWhoNah($value)
 * @mixin \Eloquent
 */
class Discord extends Model
{
    use HasFactory;

    protected $table = 'discords';

    /**
     * @return string
     */
    public function getWhoWhere(): string
    {
        $who = $this->getWhoNah();
        $where = $this->getWhereNah();
        return $who. ' '. $where;
    }

    /**
     * @return string
     */
    public function getWhoNah(): string
    {
        return $this->who_nah;
    }

    /**
     * @param string $who_nah
     */
    public function setWhoNah(string $who_nah): void
    {
        $this->who_nah = $who_nah;
    }

    /**
     * @return string
     */
    public function getWhereNah(): string
    {
        return $this->where_nah;
    }

    /**
     * @param string $where_nah
     */
    public function setWhereNah(string $where_nah): void
    {
        $this->where_nah = $where_nah;
    }

    /**
     * @return string
     */
    public function getWhenNah(): string
    {
        return $this->when_nah;
    }

    /**
     * @param string $when_nah
     */
    public function setWhenNah(string $when_nah): void
    {
        $this->when_nah = $when_nah;
    }

    /**
     * @return string
     */
    public function getHowNah(): string
    {
        return $this->how_nah;
    }

    /**
     * @param string $how_nah
     */
    public function setHowNah(string $how_nah): void
    {
        $this->how_nah = $how_nah;
    }
}
