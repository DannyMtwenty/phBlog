<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //users sees only their posts   
    public function user()
    {
       
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
       
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user)
    {
        //returns true if user has liked post        
        return $this->likes->contains('user_id', $user->id);
    }
  
  
}
