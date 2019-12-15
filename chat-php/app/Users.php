<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Users extends Model {
    protected $fillable = ['user_name','user_email'];
}