<?php 

namespace Mpwar\Component\Cache;

abstract class BaseCache
{

	/*recuperar*/
	abstract function get ($key);

	/*guardar*/
	abstract function set ($key, $content, $expiration);

	/*borrar*/
	abstract function delete ($key);

	/*generarnombredeclave    array(type => 'user' , order 'alpabetical' , controller=> 'list') */
	public function getKeyName ($parameters){

		ksort($parameters);
		$stringToReturn = implode("_", $parameters);
		$stringToReturn = md5($stringToReturn);
		return $stringToReturn;
	}
}
