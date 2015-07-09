<?php
class BaseModel{
    public $link = null;
    /*public  function  BaseModel(){
        $this->link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

        if($this->link)
        {
            mysql_select_db(SAE_MYSQL_DB,$this->link);
        }
		else{
			echo "数据库连接出错";
			exit;
		}
    }*/
    private function conn(){
        /* $this->link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

         if($this->link)
         {
             mysql_select_db(SAE_MYSQL_DB,$this->link);
         }
         else{
             echo "数据库连接出错";
             exit;
         }
         */
        $this->link = mysql_connect('localhost','root','root');
        if($this->link)
        {
            $re = mysql_select_db('new_banar',$this->link);
            mysql_query('SET NAMES utf8');

        }
        else{
            echo "数据库连接出错";
            exit;
        }
    }
    public  function  __construct(){
        $this->conn();
    }

    /**
     * 把数组的值对应到对象上
     * @param $array    数组
     */
    public function Map($array)
    {
        if(is_array($array))
            foreach($array as $key => $value)
            {
                if (property_exists($this, $key))
                {
                    $this->$key = $value;
                }
            }
    }

    /**
     * 把对象转换为数组
     * @return array
     */
    public function toArray()
    {
        $objs = get_object_vars($this);
        //unset($objs['db']);
        return $objs;
    }

    /**
     *执行SQL语句
     *@param $sql sql语句
     *@return 结果数组
     */
    public function excuteSQL($sql){


        //echo $sql;
        $result = mysql_query($sql);
        $aData = array();
        if($result === true)
            return true;
        if($result == false)
            return false;
        if($result&&$result !== true)
            while($a = mysql_fetch_array($result)){
                array_push($aData,$a);
            }
        return $aData;
    }

    /**
     * @param $table
     * @param $key
     * @param $value
     */
    public function excuteInsert($table,$key,$value){
        $sql="INSERT INTO ".$table."(";
        if(is_array($key)&&is_array($value)){
            foreach($key as $v){
                $sql= $sql.$v.",";
            }
        }
    }

    /**
     *设置或获取session
     * @param $key     键
     * @param $value=0     值
     * @return bool  or   值
     */
    public function session($key,$value = 0){
        if (!isset($_SESSION)) {
            session_start();
        }
        if(isset($value)&&$value){
            $_SESSION[$key] = $value;
            return true;
        }
        return $_SESSION[$key];
    }
}

