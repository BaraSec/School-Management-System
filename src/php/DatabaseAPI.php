<?php
class Database
{
    private static $conn = null;
     
    public function __construct() 
    {
        $dbName = '' ;
        $dbHost = 'studentswebprojects.ritaj.ps';
        $dbUsername = '';
        $dbUserPassword = '';

        try {
            self::$conn = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUsername, $dbUserPassword);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function exec($stmt)
    {
        $sql = self::$conn->prepare($stmt);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select($arr, $table, $cond, $group, $having, $order, $limit)
    {
        $stmt = "select ";

        $stmt .= implode(", ", $arr);

        if ($cond != null)
        {
            $stmt .= " from " . $table . " where " . $cond;
        }
        else
        {
            $stmt .= " from " . $table;
        }
        
        if ($group != null)
        {
            $stmt .= " group by " . $gruop;

            if ($having != null)
            {
                $stmt .= " having " . $having;
            }
        }

        if($order != null)
        {
            $stmt .= " order by " . $order;
        }

        if ($limit != null)
        {
            $stmt .= " limit " . $limit;
        }


        $sql = self::$conn->prepare($stmt);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectDistinct($arr, $table, $cond, $group, $having, $order, $limit)
    {
        $stmt = "select DISTINCT ";

        $stmt .= implode(", ", $arr);

        if ($cond != null)
        {
            $stmt .= " from " . $table . " where " . $cond;
        }
        else
        {
            $stmt .= " from " . $table;
        }
        
        if ($group != null)
        {
            $stmt .= " group by " . $gruop;

            if ($having != null)
            {
                $stmt .= " having " . $having;
            }
        }

        if($order != null)
        {
            $stmt .= " order by " . $order;
        }

        if ($limit != null)
        {
            $stmt .= " limit " . $limit;
        }


        $sql = self::$conn->prepare($stmt);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($table, $cond)
    {
        if ($cond != null)
        {
            $stmt = "delete from " . $table . " where " . $cond;
        }
        else
        {
             $stmt = "delete from " . $table;
        }
        
        $sql = self::$conn->prepare($stmt);
        $sql->execute();
    }

    public function insert($table, $arr, $values)
    {
        $stmt = "insert into " . $table;

        if($arr != null)
        {
            $stmt .= " (id, ";

            $stmt .= implode(", ", $arr);

            $stmt .= ")";
        }

        $stmt .= " values (null, ";

        for($i = 0; $i < count($values) - 1; $i++)
        {
            $stmt .= "'" . $values[$i] . "', ";
        }
        $stmt .= "'" . $values[count($values) - 1] . "')";       

        $sql = self::$conn->prepare($stmt);
        $sql->execute();
    }

    public function insertNoNullStart($table, $arr, $values)
    {
        $stmt = "insert into " . $table;

        if($arr != null)
        {
            $stmt .= " (id, ";

            $stmt .= implode(", ", $arr);

            $stmt .= ")";
        }

        $stmt .= " values (";

        for($i = 0; $i < count($values) - 1; $i++)
        {
            $stmt .= "'" . $values[$i] . "', ";
        }
        $stmt .= "'" . $values[count($values) - 1] . "')";       

        $sql = self::$conn->prepare($stmt);
        $sql->execute();
    }

    public function insertNoNullStartTwo($table, $arr, $values)
    {
        $stmt = "insert into " . $table;

        if($arr != null)
        {
            $stmt .= " ( ";

            $stmt .= implode(", ", $arr);

            $stmt .= ")";
        }

        $stmt .= " values (";

        for($i = 0; $i < count($values) - 1; $i++)
        {
            $stmt .= "'" . $values[$i] . "', ";
        }
        $stmt .= "'" . $values[count($values) - 1] . "')";       

        $sql = self::$conn->prepare($stmt);
        $sql->execute();
    }

    public function update($table, $updates, $cond)
    {
        $stmt = "update " . $table . " set " . $updates;

        if ($cond != null)
        {
            $stmt .= " where " . $cond;
        }

        $sql = self::$conn->prepare($stmt);
        $sql->execute();
    }
}
?>