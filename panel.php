<?php

     require("weixin_oop_api.php");
     require("lib/weixin.config.php");
     
     //获取接口调用凭证
     $appid = APPID;
     $appsecret = APPSECRET;

     $wx = new WeixinApi($appid,$appsecret);
     $post = '{
         "button":[
             {
                   "name":"预约",
                   "sub_button":[
                   {	
                       "type":"view",
                       "name":"点菜吧",
                       "url":"http://kladz.applinzi.com/zhzg/Order/dinner/menu.php"
                    },                    
                   {	
                       "type":"click",
                       "name":"预订席位",
                       "key":"CLICK_RESERVE"
                    },
                    {
                       "type":"view",
                       "name":"预订房间",
                       "url":"http://kladz.applinzi.com/zhzg/Order/room/AddOrder.php"
                    }]
              },
              {
                   "name":"功能",
                   "sub_button":[
                   {	
                       "type":"view",
                       "name":"客房智控",
                       "url":"http://kladz.applinzi.com/zhzg/Control/index.php"
                    },
                    {
                       "type":"click",
                       "name":"路线导航",
                       "key":"CLICK_ROUTE"
                    },
                    {
                       "type":"view",
                       "name":"玩游戏",
                       "url":"http://kladz.applinzi.com/zhzg/Games/games.php"
                    }]
               },
              {
                   "name":"我的",
                   "sub_button":[
                    {	
                       "type":"view",
                       "name":"我的订单",
                       "url":"http://kladz.applinzi.com/zhzg/Order/orderlist.php"
                    },
                    {
                       "type":"view",
                       "name":"会员中心",
                       "url":"http://kladz.applinzi.com/zhzg/Info/center.php"
                    },
                    {	
                       "type":"view",
                       "name":"联系我们",
                       "url":"http://kladz.applinzi.com/zhzg/Info/contact.php"
                    }]
               }
         ]
      }';

      $result = $wx->menu_create($post);
      print_r($result);
