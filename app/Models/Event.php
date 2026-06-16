<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id_event';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'header_img',
        'start',
        'finish',
        'status'
    ];

    public function donations()
    {
    return $this->hasMany(Donation::class, 'id_event', 'id_event');
    }
    public function trees()
    {
    return $this->belongsToMany(
        Tree::class,
        'event_tree',
        'id_event',
        'id_tree'
    );
    }
    // 1. Perbaikan: 'public' menggunakan huruf kecil
    public static function getAvailableEvent()
    {
        return [
            [
                'ID_Event'  => '001',
                'HeaderImg' => 'https://tse4.mm.bing.net/th/id/OIP.Y2-OmmzzRT6fGKczGvrVNQHaE7?rs=1&pid=ImgDetMain&o=7&rm=3',
                'Title'     => 'Cherry Blossom Planting',
                'Start'     => '12/08/27',
                'Finish'    => '12/09/27',
                'Status'    => 'Finished'
            ]
        ];
    }

    public function getID_Event()
    {
        return '001';
    }

    public function getEventTitle()
    {
        return 'Cherry Blossom Planting';
    }

    public function getEventHeader()
    {
        return 'https://tse4.mm.bing.net/th/id/OIP.Y2-OmmzzRT6fGKczGvrVNQHaE7?rs=1&pid=ImgDetMain&o=7&rm=3';
    }

    public function getEventStart()
    {
        return '12/08/27';
    }
    public function getEventFinish()
    {
        return '12/09/27';
    }
    public function getEventStatus()
    {
        return 'Finished';
    }
}
