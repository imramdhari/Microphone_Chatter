< html>
<html lang="en">

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welome To Microphone Chatter</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <nav>
            <div class="comp-name">
                <h2><span>W</span>elcome <span>T</span>o <span>M</span>icrophone <span>C</span>hatter</h2>
            </div>
            <div class = "nav_button">
            <ul>
                     <li><a href="index.php">Dashboard</a></li>
                    <li><a href="opinion.php">New Opinion</a></li>
                    <li><a href="api/Microphone/register">Register </a></li>
                    <li><a href="api/Microphone/login">Login</a></li>
                    
                    
                   
                </ul>
        </nav>

        <section class="inhead-sec">
            <h2>Microphone Chatter</h2>
            <p>Get the best Opinions for Microphone From Public</p>
        </section>
    </header>
<body>
<main>

<section class= "New_Post">
     <div class = "post_container">
   
        <div class = "microPost">     
            <div id = 'newPost' class = "micro">    
            <div id = 'selectUser' class="selectUser">
                    <h1>What is Your Name ? &nbsp&nbsp<h1>
                        <p>If you don't want to mention your details</p>
                            <p> or your name is not in the list  </p>
                                <p>then select "Anonymous"</p>
                  
            </div>
            

  <section>
  <div class= "loadingposts">

  <h1> These are the Reccomendation for you</h1>

</body>

</html>

<footer>
        <div class="foot">
            <div class="comp">
                <h4>Microphone Chatter</h4>
                <p><span>M</span>icrophone <span>C</span>hatter <span>O</span>pinions</p>
            </div>
           
            
        </div>
        <div class="copyrights">
            <p>&copy; 2020 <a href="index.php">Balvinder Singh</a>, All rights reseverd</p>
		
        </div>
    </footer>
<script>

    window.onload = function(){
        setAllUser();
    }
    var setAllUser = function(){
        var activeUser = document.getElementById('userList').value;
        document.getElementById('username').value = activeUser;
        return activeUser;
    }
  
  
    var sendLike = function(postId){
        var username = setAllUser();
        var sendALike = new XMLHttpRequest();
        var likeURI = "api/Microphone/like.php";
        var params = "postId="+postId+"&username="+username;
        sendALike.open("POST",likeURI,true);
        sendALike.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        sendALike.send(params);
    }

    const getUsers = new XMLHttpRequest();
    var usersURI = "api/Microphone/users";
    getUsers.onreadystatechange = function(){
        if(getUsers.readyState==4 & getUsers.status==200){
            var users = JSON.parse(getUsers.responseText);
            var userList = '';
            document.getElementById('selectUser').innerHTML += "<select id = 'userList' name = 'users' size = 1>";
            for(var user of users){
                userList += "<option value = "+user.name+">"+ user.name +"</option>"
            }
            document.getElementById('userList').innerHTML = userList;
            document.getElementById('selectUser').innerHTML += "</select>";
        }
    }
    getUsers.open("GET",usersURI,true);
    getUsers.send();
    const getmicroPost = new XMLHttpRequest();
    var microPostURI = "api/Microphone/microphoneposts";
    getmicroPost.onreadystatechange = function(){
        if(getmicroPost.readyState==4 & getmicroPost.status == 200){
            var microPost = JSON.parse(getmicroPost.responseText);
            var microText = "";
            for (var micro of microPost){
    
              
                microText += "<div id = "+micro.id+" class = \'micro\'>";
                microText += "<h2 class = 'microHeading'>" + micro.postName + "</h2>";
                microText += "<h3 class = 'microUser'>&nbsp&nbsp&nbsp&nbsp by "+ micro.userName +"&nbsp&nbsp&nbsp&nbsp</h3>"
                microText += "<p class = 'like'>likes : "+ micro.numLikes +"</p>";
                microText += "<p class = 'date'>"+ micro.post_date +"</p>";
                microText += "<textarea class = 'microText' cols = '148' rows = '3' disabled >" + micro.text + "</textarea><br><br>";
                microText += "<button class = 'likeButton' onclick = 'sendLike("+micro.id+")'>Like</button>&nbsp&nbsp";
                microText += "<p hidden id = 'replies'>"+JSON.stringify(micro.replies)+"</p>";
                microText += "<button  class = 'reply_Button'>Replies</button>";
                microText += "</div>";
            }
            document.getElementsByClassName('microPost')[0].innerHTML += microText + "<br>";


   

            var repliesList = document.getElementsByClassName('reply_Button');
            for(var i = 0; i< repliesList.length;i++){
                document.getElementsByClassName('reply_Button')[i].addEventListener("click",function(){
                    replies = JSON.parse(this.parentNode.querySelector('#replies').innerHTML);
                    replyText = "";
                    for(reply of replies){
                        replyText+="<div class = 'reply'>"
                            replyText+="<h3>"+reply.name+"</h3>";
                            replyText+="<p class = 'replyText1'>"+reply.text+"</p>";
                        replyText+="</div>"
                    }
                    replyText+="<br><br><input type = 'text' class = 'replyText' placeholder='Enter Reply Text Here. Select Active User to Send as.'>";
                    replyText+="<br><br><button class = 'addReply'>Add Reply</button>";
                    this.parentNode.innerHTML+=replyText;

                    var replyButtonList = document.getElementsByClassName('addReply');
                    for(var i = 0; i< replyButtonList.length;i++){
                        document.getElementsByClassName('addReply')[i].addEventListener("click",function(){
                            text = this.parentNode.querySelector(".replyText").value;
                            user = setAllUser();
                            replyId = this.parentNode.id;

                            const sendReply = new XMLHttpRequest();
                            var replyURI = "api/Microphone/reply";
                            var params = "text="+text+"&";
                                params+= "user="+user+"&";
                                params+= "id="+replyId;

                            sendReply.open("POST",replyURI,true);
                            sendReply.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            sendReply.send(params);
                        });
                    }


                });
            }

    }
}
    getmicroPost.open("GET",microPostURI,true);
    getmicroPost.send();

</script>

<link rel="stylesheet" href="css/main.css">
<style>
.admin-quick-add {
	background-color: #DDD;
	padding: 15px;
	margin-bottom: 15px ;
    margin-top: 15px auto;
    height:100%;
} 
.admin-quick-add h2{
    color: red;
    height:10px;
    fading:10px;
    text-align: center;

}
.postButton {
    color: Black;
    height:10px;
    fading:10px;
    text-align: center;
}
.admin-quick-add input,
.admin-quick-add textarea {
	width: 100%;
    height:20%;
	border: none;
	padding: 20px;
	margin: 0 0 10px 0;
	box-sizing: border-box;
    margin-top: 20px;
    margin-bottom: 20px;
    

}
*{margin:0 ;padding: 0;box-sizing: border-box; font-family: 'Poppins';}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');
header{
    background-image:url('css/images/header-bg.jpg');
    background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;
}


}
nav{
    padding: 0px 15px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2) ;
}
nav .comp-name{
    padding: 10px 0px;
    font-weight: bold;
}
nav .comp-name h2 span{
    color: #9b0000;
}
nav ul{
    list-style: none;
    display: flex;
    align-items: center;
}
nav ul li a{
    color: #fff;
    display: block;
    font-size: 14px;
    padding: 8px 15px;
    text-decoration: none;
}
nav ul li a.admin-btn{
    padding: 10px 25px;
    background-color: #9b0000;
    border: 2px solid #fff;
}


.inhead-sec{
    color: #fff;
    padding: 200px 15px;
}
.inhead-sec h2{
    font-size: 45px;
    text-align: center;
    font-family: 'Poppins';
}
.inhead-sec p{
    font-size: 14px;
    letter-spacing: 1px;
}
.inhead-sec h2 + p{
    font-size: 16px;
    text-align: center;
    margin-bottom: 2rem;
}


.sec-1{
    padding: 30px 15px;
}
.sec-1 h4{
    padding-bottom:10px;
    display: inline-block;
    border-bottom: 1px solid #9b0000;
}

.recoms{
    display: flex;
    margin-top: 40px;
    justify-content: space-between;
}
.recoms img{
    max-width: 100%;
    border-radius: 10px;
}
.line{
    flex-basis: 30%;
    transition: all .5s;
}
.line .text{
    padding: 25px 15px;
}
.line .text h6{
    font-size: 20px;
}
.line .text p{
    font-size: 14px;
    margin-bottom: 30px;
}
.line .text .read-btn{
    margin-top: 20px;
}
.line .text .read-btn a{
    color: #9b0000;
    transition: all .5s;
}
.line .text .read-btn a:hover{
    text-decoration: none;
}


footer{
    color: #fff;
    padding: 40px 15px;
    background-color: black;
}
footer .comp{
    text-align: center;
    margin-bottom: 30px;
}
footer .comp h4{
    font-size: 80px;
    color: #9b0000;
    margin:0px;
}
footer .comp h4 + p{
    font-size: 14px;
    margin-top: -25px;
}
footer .comp h4 + p span{
    color: #9b0000;
}
footer .places{
    display: flex;
    margin-bottom: 30px;
    justify-content: space-between;
}
footer .places .imgs{
    flex-basis: 32%;
}
footer .places .imgs img{
    max-width: 100%;
    border-radius: 10px;
}
footer .places .imgs p{
    text-align: center;
}
footer .copyrights{
    padding: 15px;
    text-align: center;
    border-top: 1px solid #fff;
}
footer .copyrights p a{
    color: #9b0000;
    font-weight: bold;
    text-decoration: none;
}
.post_container {
  border: 2px solid #ccc;
  background-color: Orange;
  border-radius: 5px;
  padding: 16px;
  margin: 16px 0
}

.post_container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  margin-right: 20px;
  border-radius: 50%;
}

.container span {
  font-size: 20px;
  margin-right: 15px;
}

@media (max-width: 500px) {
  .container {
      text-align: center;
  }
  .container img {
      margin: auto;
      float: none;
      display: block;
  }
}
body h1 {
text-align: center;
}

</style>
