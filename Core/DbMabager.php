<?php
namespace Core;


/**
 * Class DbMabager
 * @package Core
 */
class DbMabager
{
    /**
     * @var array
     */
    protected $connection                   = [];
    /**
     * @var array
     */
    protected $repository_connection_map    = [];
    /**
     * @var array
     */
    protected $repositories                 = [];

    /**
     * @param string $repository_name
     * @return mixed
     */
    public function fetch (string $repository_name)
    {
        if (!isset($this->repositories[$repository_name])){
            $repository_class   = $repository_name. 'Repository';
            $con                = Self::fetchConnectionForRepository($repository_name);

            $repository         = new $repository_class($con);

            $this->repositories[$repository_name] = $repository;
        }

        return $this->repositories[$repository_name];
    }

    /**
     * @param string $name
     * @param array $params
     */
    public function connect (string $name, array $params):void
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

    /**
     * @param null|string $name
     * @return mixed
     */
    public function selectConnection (?string $name = null)
    {
        if (is_null($name)) {
            return current($this->connection);
        }
        return $this->connection[$name];
    }

    /**
     * @param string $repository_name
     * @param string $name
     */
    public function registerRepositoryConnectionMap (string $repository_name, string $name):void
    {
        $this->repository_connection_map[$repository_name] = $name;
    }

    /**
     * @param string $repository_name
     * @return mixed
     */
    public function fetchConnectionForRepository (string $repository_name)
    {
        if(isset($this->repository_connection_map[$repository_name])){
            $name   = $this->repository_connection_map[$repository_name];
            $con    = Self::selectConnection($name);
        } else {
            $con    = Self::selectConnection();
        }
        return $con;
    }

    public function __destruct():void
    {
        foreach ($this->repositories as $repository) {
            unset($repository);
        }
        foreach ($this->repositories as $con) {
            unset($con);
        }
    }
}