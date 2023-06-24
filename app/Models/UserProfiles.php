<?php

namespace App\Models;

use App\Models\Indonesia\District;
use App\Models\Indonesia\Province;
use App\Models\Indonesia\Regency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProfiles
 *
 * @property int $id
 * @property int $user_id User ID
 * @property string $name
 * @property string|null $image
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $postal_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read District|null $district
 * @property-read mixed $image_path
 * @property-read Province|null $province
 * @property-read Regency|null $regency
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereRegencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfiles whereVillageId($value)
 *
 * @mixin \Eloquent
 */
class UserProfiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'phone',
        'address',
    ];

    protected $guarded = ['created_at', 'updated_at'];

    protected $appends = ['image_path'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getImagePathAttribute()
    {
        if (! $this->image) {
            return null;
        }

        // localhost to 127.0.0.1
        $asset = asset('storage/'.$this->image);
        $asset = str_replace('http://localhost', 'http://127.0.0.1', $asset);

        return $asset;
    }
}
