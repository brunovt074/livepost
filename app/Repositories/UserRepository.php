<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function() use($attributes){            

            $created = User::query()->create([
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email'),                
            ]);
            return $created;
        });

    }

    /**
    * @param User $user 
    * @param array $attributes
    * @return mixed
    */
    public function update($user, array $attributes){
        
        return DB::transaction(function() use($user, $attributes){
            $updated = $user->update([
                'name' => data_get($attributes,'name'),
                'email' => data_get($attributes, 'email')
            ]);
    
            if(!$updated){
                throw new \Exception("Cannot update de user.");
            }
    
            return $user;
        });        
    }
    
    /**
    * @param User $user
    * @return mixed 
    */
    public function forceDelete($user){

        $deleted = $user->forceDelete();

        if(!$deleted){
            throw new \Exception("Failed to delete user");
        }

        return $deleted;

    }
}
