<?php
namespace Core;


/**
 * Class DbRepository
 * @package Core
 */
class DbRepository
{
    /**
     * @var
     */
    protected $con;

    /**
     * DbRepository constructor.
     * @param $con
     */
    public function __construct ($con)
    {
        $this->registerConnection($con);
    }

    /**
     * @param $con
     */
    public function registerConnection ($con)
    {
        $this->con = $con;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function execute (string $sql, array $params = [])
    {
        $stmt = $this->con->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetch (string $sql, array $params = [])
    {
        return Self::execute($sql,$params)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetchAll (string $sql, array $params = [])
    {
        return Self::execute($sql,$params)->fetchAll(PDO::FETCH_ASSOC);
    }
}