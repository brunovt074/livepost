<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralJsonException;

class UserRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function() use($attributes){            

            $created = User::query()->create([
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email'),                
            ]);
            
            throw_if(!$created, GeneralJsonException::class, 'Cannot create the user.');
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
    
            throw_if(!$updated, GeneralJsonException::class, 'Cannot update the user.');            
    
            return $user;
        });        
    }
    
    /**
    * @param User $user
    * @return mixed 
    */
    public function forceDelete($user){

        $deleted = $user->forceDelete();

        throw_if(!$deleted, GeneralJsonException::class, 'Cannot delete the user.');            

        return $deleted;

    }
}
