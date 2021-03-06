<!doctype html>
<html>
<head>
<title></title>
</head>
<body>
<div>HTML5 WebSocket</div>
<div id="info"></div>
<input id="msg" type="text" onkeypress="onkey(event)" />
<button onclick="send()">发送</button>
<button onclick="quit()">断开</button>

<script type="text/javascript">
	var socket;	//声明socket
	function init(){	//初始化
		var host="ws://echo.websocket.org/";	//声明host，注意是ws协议
		try{
			socket=new WebSocket(host);	//新建一个socket对象
			log('当前状态：'+socket.readyState);	//将连接的状态信息显示在控制台
			socket.onopen=function(msg){
				log("打开连接："+this.readyState);	//监听连接				
			};			
			socket.onmessage=function(msg){
				log("接收消息："+msg.data);	//监听当接收消息时触发匿名函数				
			};			
			socket.onclose=function(msg){
				log("断开连接："+this.readyState);	//关闭连接				
			};			
			socket.onerror=function(msg){
				log("错误信息："+this.readyState);	//监听错误信息			
			};
		}catch(ex){
			log(ex);
		}
		$("msg").focus();
	}
	function send(){	//发送信息
		var txt,msg;
		txt=$("msg");
		msg=txt.value;
		if(!msg){
			alert("文本框不能够为空");
			return;
		}
		txt.value="";
		txt.focus();
		try{
			socket.send(msg);
			log("发送信息："+msg);
		}catch(ex){
			log(ex);
		}
	}
	function quit(){	//关闭socket
		log("再见");
		socket.close();
		socket=null;
	}
	//根据id获取DOM元素
	function $(id){
		return document.getElementById(id);
	}
	//将信息显示在id为info的div中
	function log(msg){
		$("info").innerHTML+="<br/>"+msg;
	}
	//键盘事件(回车)
	function onkey(event){
		if(event.keyCode==13){
			send();
		}
	}
	init();
</script>
</body>
</html>
