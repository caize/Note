<?php

namespace App\Models;

use App\Helpers\Markdowner;
use App\Helpers\Traits\Favoritable;
use App\Helpers\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use Favoritable,RecordsActivity;

    protected $guarded = [];


    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function commentable()
    {
        return $this->morphTo();
    }

    public function setContentAttribute($value)
    {
        $data = [
            'raw'  => $value,
            'html' => (new Markdowner())->convertMarkdownToHtml($value)
        ];

        $this->body = json_encode($data);
    }



}
