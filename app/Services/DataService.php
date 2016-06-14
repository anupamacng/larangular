<?php
namespace App\Services;
use DB;

class DataService
{
    
    /**
     * Create a new data service controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Return friend's information.
     *
     * @param  int $request
     * @return User 
     */
    public function getFriendList($id,$point)
    {
        $sql = "SELECT u.name, 
       			u.email, u.latitude, u.longitude,
                111.1111 *
    	DEGREES(ACOS(COS(RADIANS(u.latitude))
         * COS(RADIANS($point->latitude))
         * COS(RADIANS(u.longitude - $point->longitude))
         + SIN(RADIANS(u.latitude))
         * SIN(RADIANS($point->latitude)))) AS distance_in_km
				FROM   `users` AS u 
				WHERE  u.id IN (SELECT DISTINCT user_one_id 
                FROM   relationships 
                WHERE  user_two_id = '$id' 
                UNION 
                SELECT user_two_id 
                FROM   relationships 
                WHERE  user_one_id = '$id')";
       	$results = DB::select( DB::raw($sql));
    	return $results;
    }

    /**
     * Return friend's information.
     *
     * @param  int $request
     * @return User 
     */
    public function getUserList($id)
    {
        $sql = "SELECT u.id , u.name, r.status FROM users as u left join relationships as r 
        ON (u.id = r.user_one_id OR u.id=r.user_two_id) 
        and (r.user_one_id = '$id' OR r.user_two_id ='$id') 
        AND (u.id != '$id') ORDER By u.id";
        $results = DB::select( DB::raw($sql));
        return $results;
    }

    public function getUserPoint($id)
    {
    	$point = DB::table('users')
    			->select('id','latitude', 'longitude')
    			->where('id', '=', $id)
    			->get();
    	return $point[0];
    }

}
