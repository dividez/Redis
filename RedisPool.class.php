<?php

class RedisPool {
	private static $connections = array();
	private static $servers = array();
	
	public static function add_servers($list){
		foreach ( $list as $alias => $data )
		{
			self::$servers[$alias] = $data;
		}
	}
	
	public static function get($alias){
		if ( !array_key_exists($alias, self::$connections) )
		{


				$redis=new Redis();
				$redis->connect(self::$servers[$alias][0],self::$servers[$alias][1]);
				self::$connections[$alias]=$redis;
				if(isset(self::$servers[$alias][2])){
					var_dump(self::$servers[$alias][2]);
						self::$connections[$alias]->auth(self::$servers[$alias][2]);
				}
		}
		return self::$connections[$alias];
	}

	
}


?>