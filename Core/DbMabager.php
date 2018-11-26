<?php
namespace Core;


class DbMabager
{
    protected $connection = [];

    public function connect (string $name,array $params):void
    {
        $params = array_merge(
            [
                'dsn'       =>  null,
                'user'      =>  '',
                'password'  =>  '',
                'options'   =>  [],
            ],$params
        );

        $con = new PDO(
            $params['dsn'],
            $params['user'],
            $params['password'],
            $params['options']
        );

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connection[$name] = $con;
    }

    public function selectConnection (?string $name = null)
    {
        if (is_null($name)) {
            return current($this->connection);
        }
        return $this->connection[$name];
    }

}