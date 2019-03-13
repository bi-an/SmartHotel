<?php
    
 	  require 'model/SendMsgDB.php';
    
    class WeixinApi
	 {
        private $appid;
		private $appsecret;
        private $sendmsg;
        
        //构造方法 对成员属性进行赋值操作的
		    public function __construct($appid="",$appsecret="")
		    {
			    $this->appid     = $appid;
			    $this->appsecret = $appsecret;
		    }

		    //验证消息
		    public function valid()
		    {
			     if($this->checkSignature())
			     {
				      echo $_GET['echostr'];
			     }
			     else
			     {
				      echo "Error";
			     }
		    }

		    //检验微信加密签名Signature
		    private function checkSignature()
		    {
			     $signature = $_GET['signature'];//微信加密签名
			     $timestamp = $_GET['timestamp'];//时间戳
			     $nonce     = $_GET['nonce'];    //随机数
		
		       //2、加密/校验
			     //(1). 将token、timestamp、nonce三个参数进行字典序排序；
			     $tmpArr = array(TOKEN,$timestamp,$nonce);
			     sort($tmpArr,SORT_STRING);

			     //(2)将三个参数字符串拼接成一个字符串进行sha1加密；
			     $tmpStr = implode($tmpArr);
			     $tmpStr = sha1($tmpStr);

			     //(3) 开发者获得加密后的字符串与signature对比。
			     if($tmpStr == $signature)
			     {
				      return true;
			     }
			     else
			     {
				      return false;
			     }
		    }

		    //响应消息
		    //responseMsg()
		    public function responseMsg()
		    {
             $this->sendmsg = new SendMsgDB();
            
            //接收XML数据包
			      $postData = $GLOBALS[HTTP_RAW_POST_DATA];//注意：这个需要设置成全局变量

			      //处理XML数据包
			      $xmlObj = simplexml_load_string($postData,"SimpleXMLElement",LIBXML_NOCDATA);

			      $toUserName = $xmlObj->ToUserName; //获取开发者微信号
			      $fromUserName = $xmlObj->FromUserName; //获取用户的OpenID
			      $msgType = $xmlObj->MsgType; //消息的类型
			      
			      //根据消息类型来进行业务处理
			      switch ($msgType) 
			      {
				       case 'event':  //接收事件推送
					           echo $this->receiveEvent($xmlObj);
					           break;
				
				       case 'text':   //接收文本消息
					          echo $this->receiveText($xmlObj);
                    break;
			  
			        case 'image':   //接收图片消息
					          echo $this->receiveImage($xmlObj);
					          break;
			 
			        case 'location':
                    $userLocData = $xmlObj;
                    $userLocData->addChild('Latitude',$xmlObj->Location_X);
                    $userLocData->addChild('Longitude',$xmlObj->Location_Y);
                    $this->sendmsg->saveUserLocation($xmlObj);
                    //回复一个图文消息
							      $newsArr = array(
							                         array(
							                                 'Title'=>"科莱安客控酒店导航",
                                               'PicUrl'=>"http://kladz.applinzi.com/imag/hotel.jpg",
							                                 'Url'=>"http://kladz.applinzi.com/route.php?user=".$xmlObj->FromUserName,
							                               )
							                      );					
							      echo $this->replyNews($xmlObj,$newsArr);
                    break;
                
              default:
					              break;
		        }
        }

		   //接收事件推送
		   //receiveEvent($obj)

		   public function receiveEvent($obj)
		   {
				 switch ($obj->Event) 
				 {
					 //接收关注事件
					 case 'subscribe':
						   //下发欢迎语
						   $newsArr = array(
								       	          array("Title"=>"福建科莱安电子科技有限公司欢迎您！", 
                                         "Description"=>"专业专注酒店设备开发", 
                                         "PicUrl"=>"http://kladz.applinzi.com/imag/login.png", 
                                         "Url" =>"http://www.kladz.cn/about.aspx?introCateId=70&CateId=70"),
										           );					
							return $this->replyNews($obj,$newsArr);						
							break;
					
					//接收取消关注事件
					case 'unsubscribe':
					     //账号的解绑
						    break;
					 
          case 'CLICK':
						    switch($obj->EventKey)
						    {
							      
                                 case 'ROUTE':
                                                return $this->replyText($obj,'【科莱安客控酒店路线导航】
                                                                       试试发送你的位置，即可为您指引到各个分店线路:
                                                                       1. 点击左下方“小键盘”
                                                                       2. 点击打字窗口旁边的“+号键”
                                                                       3. 选择“位置”图标
                                                                       4. 完成定位后点击右上角“发送”');
                                               
                                                
                                                                                             
								                 break;
                                
                               							
                              case 'introduce':
								                   //回复一个图文消息
								                     $newsArr = array(
									                                       array(
										                                             'Title'=>"福建科莱安电子科技有限公司欢迎您！", 
                                                                 'Description'=>"专业专注酒店设备开发", 
                                                                 'PicUrl'=>"http://kladz.applinzi.com/imag/login.png", 
										                                             'Url'=>"http://www.kladz.cn",
									                                             )
													                           );					
								                   return $this->replyNews($obj,$newsArr);						
								                   break;
                            
                             case 'contract':
								                 //回复一个文本消息
								                  return $this->replyText($obj,"福建科莱安电子科技有限公司\n 联系方式：059187861580 \n 网址：www.kladz.com \n 地址：福州市鼓楼区铜盘路软件大道89号软件软件园G区11栋");
					                        break;
                               
                            
                           
						    }
						    break;
				default:
				    		# code...
						    break;
				 }			
		  }

		  //接收文本消息
		  public function receiveText($obj)
		  {
			   $content = trim($obj->Content); //获取文本消息的内容
			   //关键字回复
			   switch ($content) 
			   {
				   case 'test':
					      return $this->replyText($obj,"TEL：18050282232 \n QQ：33434796 \n 微信号：18050282232");
					      break;
				
				   case '图文':
					       $newsArr = array(
							 		             );					
					       return $this->replyNews($obj,$newsArr);
					       break;			
				  
				   default:
					       return $this->replyText($obj,$content);
					       break;
			 }
      }


		  //回复文本消息
		  public function replyText($obj,$content)
		  {
			   //回复文本消息

			  $replyTextMsg = "<xml>
				              				<ToUserName><![CDATA[%s]]></ToUserName>
								              <FromUserName><![CDATA[%s]]></FromUserName>
								              <CreateTime>%s</CreateTime>
								              <MsgType><![CDATA[text]]></MsgType>
								              <Content><![CDATA[%s]]></Content>
							          </xml>";
			  return sprintf($replyTextMsg,$obj->FromUserName,$obj->ToUserName,time(),$content);
		  }

		  //接收图片消息
		  public function receiveImage($obj)
		  {
			   $picUrl = $obj->PicUrl;//获取图片的URL
			   $mediaId = $obj->MediaId;//获取图片消息媒体id
			   $picArr = array('picUrl'=>$picUrl,'mediaId'=>$mediaId);
			   return $this->replyImage($obj,$picArr);
      }


		  //回复图片消息
		  public function replyImage($obj,$array)
		  {
			  //回复图片消息
			  $replyImageMsg = "<xml>
								               <ToUserName><![CDATA[%s]]></ToUserName>
								               <FromUserName><![CDATA[%s]]></FromUserName>
								               <CreateTime>%s</CreateTime>
								               <MsgType><![CDATA[image]]></MsgType>
								               <Image>
									                     <MediaId><![CDATA[%s]]></MediaId>
								               </Image>
							            </xml>";
			  return sprintf($replyImageMsg,$obj->FromUserName,$obj->ToUserName,time(),$array['mediaId']);
		  }

		  //回复图文消息
		  public function replyNews($obj,$newsArr)
		  {
			   $itemStr = "";
			   if(is_array($newsArr))
			   {

				  foreach ($newsArr as $item) 
				  {
					   $itemTmpl = "<item>
							              		<Title><![CDATA[%s]]></Title> 
									              <Description><![CDATA[%s]]></Description>
									              <PicUrl><![CDATA[%s]]></PicUrl>
									              <Url><![CDATA[%s]]></Url>
							            </item>";
					   $itemStr .= sprintf($itemTmpl,$item['Title'],$item['Description'],$item['PicUrl'],$item['Url']);
				 }
				 $replyNewsMsg = "<xml>
					               				<ToUserName><![CDATA[%s]]></ToUserName>
									              <FromUserName><![CDATA[%s]]></FromUserName>
									              <CreateTime>%s</CreateTime>
									              <MsgType><![CDATA[news]]></MsgType>
									              <ArticleCount>%s</ArticleCount>
									              <Articles>".$itemStr."</Articles>
								          </xml> ";

				 return sprintf($replyNewsMsg,$obj->FromUserName,$obj->ToUserName,time(),count($newsArr));		
			   }			
		  }

		  //https请求(GET和POST)
		  public function https_request($url,$data=null)
		  {
			  $ch = curl_init();

			  curl_setopt($ch, CURLOPT_URL, $url);
			  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //将页面以文件流的形式保存
			  
			  if(!empty($data))
			  {
				  curl_setopt($ch, CURLOPT_POST, 1);//模拟POST请求

				  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//POST提交内容
			  }
			  $outopt = curl_exec($ch);

			  curl_close($ch);

			  return json_decode($outopt,true);//返回数组结果
		  }

		  //获取接口调用凭证access_token
		  public function getAccessToken()
		  {
			   $access_token = $this->_memcache_get("access_token");
			   if(!$access_token)
			   {
				   $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appsecret}";
				   $result = $this->https_request($url);
				   $this->_memcache_set("access_token",$result['access_token'],7000);
				   return $result['access_token'];				
			  }

			  return $access_token;
		  }

		  //实例化memcache
		  public function _memcache_init()
		  {
			  //实例化对象
			  $mmc = new Memcache();

			  $mmc->connect();//使用当前应用的memcache

			  return $mmc;			
		  }

		  //设置memcache
		  public function _memcache_set($key,$value,$time=0)
		  {
			   $mmc = $this->_memcache_init();
			   $mmc->set($key,$value,0,$time);
		  }

		  //获取memcache
		  public function _memcache_get($key)
		  {
			   $mmc = $this->_memcache_init();
			   return $mmc->get($key);
		  }

		  //自定义菜单创建
		  public function menu_create($post)
		  {
			   $access_token = $this->getAccessToken();
			   $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
			   return $this->https_request($url,$post);
		  }

		  //自定义菜单查询
		  public function menu_select()
		  {
			  $access_token = $this->getAccessToken();
			  $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$access_token}";
			  return $this->https_request($url);
		  }

		  //自定义菜单删除
		  public function menu_delete()
		  {
			  $access_token = $this->getAccessToken();
			  $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
			  return $this->https_request($url);
		  }

		  //base型授权
		  public function snsapi_base($redirect_uri)
		  {
			   // 1、准备Scope为snsapi_base的网页授权页面URL；
			   $redirect_uri = urlencode($redirect_uri);
			   $snsapi_base_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state=123#wechat_redirect";

			   // 2、静默授权，获取code；

			   // 页面将跳转至 redirect_uri/?code=CODE&state=STATE
			   if(!isset($_GET['code']))
			   {
				    header("Location:{$snsapi_base_url}");
			   }

			   $code = $_GET['code'];

			   // 3、通过code换取网页授权access_token。

			   $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
			   return $this->https_request($url);
		  }

		  //userinfo型授权
		  public function snsapi_userinfo($redirect_uri)
		  {
			  // 1、准备Scope为snsapi_userinfo的网页授权页面URL；
			  $redirect_uri = urlencode($redirect_uri);
			  $snsapi_userinfo_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
			  // 2、用户手动同意授权，获取code；

			  // 页面将跳转至 redirect_uri/?code=CODE&state=STATE
			  if(!isset($_GET['code']))
			  {
				  header("Location:{$snsapi_userinfo_url}");
			  }

			  $code = $_GET['code'];

			  // 3、通过code换取网页授权access_token。

			  $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
			  $result = $this->https_request($url);

			  $access_token = $result['access_token'];
			  $openid = $result['openid'];

			  //4、根据上一步获取的access_token和openid拉取用户信息。

			  $userinfo_url =  "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
			  return $this->https_request($userinfo_url);
		  }
	 }

?>