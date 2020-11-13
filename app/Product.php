<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price'];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public static function checkForDuplicate($name, $price)
    {
        return \DB::table('products')->where([
            ['name', '=', $name],
            ['price', '=', $price]
        ])->first();
    }

    public static function addUpToQantity($name, $price)
    {
        $product = self::findOrFail(self::checkForDuplicate($name, $price)->id);
        $product->quantity += 1;
        $product->save();

        return $product;
    }
}
