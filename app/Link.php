<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class Link extends Model
{
	protected $fillable = [
		'url', 'hash', 'last_accessed',
	];

    public static function validate(Request $request)
    {
        // laravel 'url' validate rules wants a protocol
		$request->merge([
            'url' => Str::startsWith($request->url, 'http')
                ? $request->url
                : 'http://'.$request->url
        ]);

        return Validator::make($request->all(), [
            'url' => 'required|url',
        ]);
    }

    public function scopeByHash($query, $hash)
    {
        return $query->where('hash', $hash);
    }
}
