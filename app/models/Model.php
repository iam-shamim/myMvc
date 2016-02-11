<?php
namespace app\models;
class Model{
    private function __construct () { }
    private static $_instance = null;
    protected static $host     = DB_HOST;
    protected static $user     = DB_USER;
    protected static $pass     = DB_PASS;
    protected static $dbName   = DB_NAME;
    protected static $dns;
    public static $connect;
    public static $dbError=false;
    public $rows=[];
    public static $instances='$this';

    public static $currentTableName='users';

    public static function db(){
        self::$dns='mysql:dbname='.self::$dbName.';host='.self::$host;
        try{
            if(empty(self::$connect)){
                self::$connect=new \PDO(self::$dns,self::$user,self::$pass);
            }
            return self::$connect;
        }catch (PDOException $e){
            self::$dbError='Connect failed: '.$e->getMessage();
        }
    }
    public static function __callStatic($name, $arguments){echo $name;}

    public static function tableName(){
        if(isset(static::$table)){
            self::$currentTableName=static::$table;
            return static::$table;
        }else{
            $exp=explode(trim('\ '),get_called_class().'s');
            self::$currentTableName=end($exp);
            return end($exp);
        }
    }
    public static function all($columns='*'){
        $db=self::db();
        echo self::$dbError;
        $table=self::tableName();
        $pre=$db->prepare("SELECT $columns FROM $table");
        $pre->execute();
        return $pre->fetchAll(\PDO::FETCH_OBJ);
    }
    public  static function find($id){
        $db=self::db();
        echo self::$dbError;
        $table=self::tableName();
        $pre=$db->prepare("SELECT * FROM $table WHERE `id`=:id");
        $pre->bindParam(':id',$id);
        $pre->execute();
        return $pre->fetchObject();
    }
    public static function update(){
         self::$currentTableName;
    }
    public  function test(){

    }
}