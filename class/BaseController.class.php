<?php
/*
 * Author:黄星
 * Date:10-15
 *基础控制器
 * */
class BaseController{
     /**
      * @param        $key
      * @param string $default
      *
      * @return string
      */
     public function getParam($key, $default = '')
     {
         if ($_GET && isset($_GET[$key]))
         {
             return $_GET[$key];
         }
         elseif ($_POST && isset($_POST[$key]))
         {
             return $_POST[$key];
         }
         return $default;
     }

    /**
     * 得到安全的页面参数
     * @param        $key           关键字
     * @param string $default       默认值
     *
     * @return string               返回_POST或_GET中的关键字对应值
     */
    public function secParam($key, $default = '')
    {
        $data = $this->getParam($key, $default);
        $data = trim($data);
        return htmlspecialchars($data);
    }

    /**
     * 设置session
     * @param $key                  关键字
     * @param $value                对应的值
     * @return                      是否设置成功
     */
    public function setSession($key, $value)
    {
        if ($key && $value)
        {
            $_SESSION[$key] = $value;
            return true;
        }
        return false;
    }
	/**
	 * 获取session
	 * @param $key                  关键字
	 * @return                      值
	 */
	public function getSession($key)
	{
		if ($key)
		{
			return $_SESSION[$key];

		}
		return false;
	}
	/**
	 *设置或获取session
	 *@param $key     键
	 *@param $value=0     值
	 * @return bool  or   值
	 */
	public function session($key,$value = 0){
		session_start();
		if(isset($value)&&$value){
			$_SESSION[$key] = $value;
			return true;
		}
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		else
			return false;
	}

    /**
     * 把数组转换为json输出到页面
     * @param $result       数组
     */
    public function json($result)
    {
        if (is_array($result) && count($result) > 0) {
            echo(json_encode($result));
        }
        exit(0);
    }
}
