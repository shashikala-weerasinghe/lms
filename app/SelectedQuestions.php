<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectedQuestions extends Model
{
    protected $table        = 'selected_questions';
    protected $primaryKey   = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;

}
