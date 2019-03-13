<?php
/**
 * 微信消息数据库操作类
 */
include_once 'SaeDB.class.php';
class SendMsgDB {
    private $db;
    public function __construct() {
        $this->db=  SaeDB::getInstance();   
    }
    
    /**
     * 保存用户最近的地理位置
     * @param type $data 微信消息体
     * @return boolean
     */
    public function saveUserLocation($data) {       
        $FromUserName=$this->db->escape($data->FromUserName);
        $CreateTime=  intval($data->CreateTime);
        $Latitude=doubleval(($data->Latitude));       
        $Longitude=doubleval($data->Longitude);
        $sql = "UPDATE  `z_user` SET  `Latitude` =  '{$Latitude}',
            `Longitude` =  '{$Longitude}',
            `CreateTime` =  '{$CreateTime}' WHERE  `z_user`.`OpenId` ='{$FromUserName}';";
        $this->db->runSql( $sql );
        if($this->db->affectedRows() < 1){//if update fails,then insert one
            $sql="INSERT INTO `z_user` (`Id`, `Latitude`, `Longitude`, `OpenId`, `Loctime`) VALUES ".
                "(NULL, '{$Latitude}', '{$Longitude}', '{$FromUserName}','$CreateTime');";        
            $this->db->runSql( $sql );
            if( $this->db->errno() != 0 ){
                sae_log("存入位置信息失败,错误原因为：".$this->db->errmsg()."出错sql为：".$sql);
                return FALSE;            
            }
        }        
        return TRUE;
    }
    
    /**
     * 获取用户最近位置
     * @param type $data 微信消息体
     * @return type
     */
    public function getUserLocation($data){
         $FromUserName=$this->db->escape($data->FromUserName);
         $sql = "SELECT * FROM  `z_user` where OpenId = '{$FromUserName}' order by `LocTime` desc limit 1";
         return $this->db->getLine( $sql );
    }  
    
    /**
     * 获取用户最近预约情况
     * @param type $data 微信消息体
     * @return type
     */
    public function getRecentReserve($data) {
        $openid=$this->db->escape($data->FromUserName);
        $sql = "SELECT * 
        FROM  `z_userdinnerinfo` 
        WHERE  `OpenId` LIKE  '{$openid}' order by dinertime desc";
        return $this->db->getLine( $sql );
    }
}