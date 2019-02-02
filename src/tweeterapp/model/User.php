<?php

namespace tweeterapp\model;

class User extends \Illuminate\Database\Eloquent\Model {

       protected $table      = 'user';  /* le nom de la table */
       protected $primaryKey = 'id';     /* le nom de la clé primaire */
       public    $timestamps = false;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */


public function liked(){
	return $this->belongsToMany('tweeterapp\model\Tweet','like','user_id','tweet_id');
}

public function followedBy(){
	return $this->BelongsToMany('tweeterapp\model\User','follow','followee','follower');

}

public function follows(){
	return $this->BelongsToMany('tweeterapp\model\User','follow','follower','followee');

}
public function tweets(){
	return $this->hasMany('tweeterapp\model\Tweet','author');
}

}


