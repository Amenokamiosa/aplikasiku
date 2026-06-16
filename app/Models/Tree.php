<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $table = 'trees';
    protected $primaryKey = 'id_tree';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'tree_img',
        'price'
    ];

    public function events()
    {
        return $this->belongsToMany(
            Event::class,
            'event_tree',
            'id_tree',
            'id_event'
        );
    }
    
    
    public static function getAvailableTrees()
    {
        return [
            ['ID_Tree' => '001', 'Img' => 'https://static.vecteezy.com/system/resources/previews/053/732/123/non_2x/pink-cherry-blossom-tree-in-spring-free-photo.jpeg', 'Name' => 'Cherry Blossom', 'Price' => '12000'],
            ['ID_Tree' => '002', 'Img' => 'https://cdn.shopify.com/s/files/1/0059/8835/2052/files/Reliance_peach_3c6d0e76-3c21-484b-b40f-92bc4549372e_1.jpg?v=1707327445', 'Name' => 'Peach', 'Price' => '24000'],
        ];
    }
}
