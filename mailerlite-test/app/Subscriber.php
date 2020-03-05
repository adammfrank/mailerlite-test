<?php

namespace App;

use App\Field;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public static $states = [
        'active',
        'unsubscribed',
        'junk',
        'bounced',
        'unconfirmed',
    ];

    public static $rules = [
        'name' => 'required',
        'email_address' => 'required|email:rfc,dns',
        'state' => 'required|in:1,2,3,4,5',
        'fields' => 'sometimes',
    ];

    public $fillable = [
        'name',
        'email_address',
        'state',
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
