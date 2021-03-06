<?php

App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

class CustomPasswordHasher extends AbstractPasswordHasher
{
    public function hash($password)
    {
        return sha1(Security::salt() . $password);
    }

    public function check($password, $hashedPassword)
    {
        return sha1(Security::salt() . $password) === $hashedPassword;
    }

	public function gen($var){
		return  sha1(Security::salt() . $var);
	}

}
