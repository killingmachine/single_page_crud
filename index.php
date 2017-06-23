<?php

require "assets/include/db.php";
require "assets/include/user_class.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="assets/js/angular.min.js"></script> -->
    <script src="assets/js/frame.js"></script>
    <script src="assets/js/functions.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title></title>
 <?php
    $sql = $conn->query("SELECT COUNT(user_id) FROM user");
    $row = $sql->fetch();
    $rowCount = $row["COUNT(user_id)"];
 ?>
<script type="text/javascript">
  var rpp = 2;
  var rowCount = <?php echo $rowCount; ?>;
    function nxt(){
      tbody.innerHTML = 'wait....';
        var ajax =ajaxObj("POST","response.php");
        ajax.onreadystatechange =function(){
            tbody.innerHTML = ajax.responseText;
            a();
        } 
        ajax.send('upTable='+rpp);
    }
    
</script>
</head>
<script type="text/javascript">
     
      var emReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

       
      window.addEventListener("load",function(){
        
           var paginate = getId('paginate');
           function pg(){

           // alert(rowCount);
              rpp+=rpp;
              var ajax =ajaxObj("POST","response.php");
              ajax.onreadystatechange = function(){
                  tbody.innerHTML = ajax.responseText;
              }
              tbody.innerHTML = 'wait....';
              ajax.send('upTable=' +  rpp);

           }
           paginate.addEventListener('click',pg);



           re_run();
           var addBtn = getId("addBtn");
           var u_valid = getId("u_valid");
            addBtn.addEventListener('click',function(){
                  var userName = getId("userName");
                  var pass = getId('pass');
                  var email = getId("email");
                  var xdte = new Date();
                  var abc = '';
                  var daT = xdte.getFullYear() + "-"  + addZero(xdte.getMonth()+1,abc) + "-" + addZero(xdte.getDate(),abc) + ' ' + addZero(xdte.getHours(),abc) + ":" + addZero(xdte.getMinutes(),abc) + ":" + addZero(xdte.getSeconds(),abc); 
                  console.log(daT);
                  var errMsg = getId("errMsg");
                  if(userName.value == '' || pass.value== '' || email.value == ''){
                      alert("pls fill up the textboxes");
                  }
                  else{
                    if(emReg.test(email.value)){
                       var ajax = ajaxObj("POST","response.php");
                         ajax.onreadystatechange =function(){
                          if(ajaxReturn(ajax)){
                            
                            errMsg.innerHTML = ajax.responseText; 
                            userName.value = '';
                            pass.value = '';
                            email.value = '';
                            a(); 
                          }
                          
                        }
                        errMsg.innerHTML = 'wait....';
                        ajax.send("uname="+userName.value+"&pass="+pass.value+"&email="+email.value+"&daT="+daT);
                    }
                    else{
                      alert('pls enter a valid email');
                    }
                  }

              });

      });
</script>




<table id='tbl' class='table'>

	<thead style='background-color: rgb(50,50,50);'>
    <tr style='color:white;'>
  		<td>username</td>
  		<td>password</td>
  		<td  colspan ='5'>email</td>
    </tr>
	</thead>

	<tbody id='tbody'>
		<?php
			// ///parameters: pdo_connection,table,limit
			// $users = CrudTbl::display($conn,'user',2); ///this will return query object
			// while($result = $users->fetch(PDO::FETCH_OBJ)){
			// 	echo "<tr>";
			// 	echo "<td>".$result->user_name."</td>";
			// 	echo "<td>".md5($result->password)."</td>";
			// 	echo "<td>".$result->email."</td>";
			// 	echo "<td><button class='updateBtn' data-toggle='modal' data-target='#k' value='$result->user_id'>Update</button><td>";
			// 	echo "<td><button data-toggle='modal' data-target='#delModal' value='$result->user_id' class='delBtn' >Delete</button><td>";
			// 	echo "<tr/>";

				
			// }			
		?>
	</tbody>
	<script type="text/javascript">
   var tbody = getId('tbody'); 
  </script>
</table>

<body>




<button data-toggle="modal" data-target="#myModal">Add</button><button id='paginate'>Load more</button>

<!-- //del modal -->
<div id="delModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
            <center>
            <span id='delMsg'></span>
            </center>
            <button data-dismiss="modal">OK</button>
            <br>
            <br>
          </div>
      </div>

  </div>
</div>
<!-- ////update modal -->
<div id='k' class='modal fade' role='dialog'>
    <div class=modal-dialog>        
      <div class=modal-content>         
          <div id='mdalCont' class=modal-body>
            
            
          </div>
          
      </div>
    </div>
</div>

<!-- add modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    	
    	<div class="modal-content">
      		<div class="modal-body">
      			<label for='userName'>username:</label>
        		<input id='userName' class="form-control" type='text' id='userName'>
        		<span id='u_valid'></span><br/>
        		<label for='pass'>password:</label>
        		<input class="form-control" type='password' id='pass'>
        		<label for='email'>email</label>
        		<input class="form-control" type='text' id='email'>
      			<button id='addBtn'>add</button><button data-dismiss="modal">cancel</button><br/>
            <span id='errMsg'></span>
      			<br>
      			<br>
      		</div>
      		
      
    	</div>

  </div>
</div>
<script type="text/javascript">
 function re_run(){
    /////del

    var tbody = getId(tbody);
    var delBtn = document.getElementsByClassName("delBtn");
      for(var i=0;i< delBtn.length;i++){
          delBtn[i].onclick = function(){
          var ajax = ajaxObj("POST","response.php");
          ajax.onreadystatechange =function(){
            if(ajaxReturn(ajax)){
                delMsg.innerHTML = ajax.responseText; 
                a(); 
            }           
          }
          delMsg.innerHTML = 'wait....';
          console.log(this.value);
          ajax.send("del="+this.value);     
          } 
      }
    
      
          userName.onblur = function(){
            var ajax = ajaxObj("POST","response.php");
            ajax.onreadystatechange =function(){
              if(ajaxReturn(ajax)){
                
                u_valid.innerHTML = ajax.responseText;  
              }
              
            }
            u_valid.innerHTML = 'wait....';
            ajax.send("chkUname="+this.value);
                
          }
          /////update
          var updateBtn  = document.getElementsByClassName('updateBtn');
          var mdalCont = getId('mdalCont');
          for(var i = 0 ;i<updateBtn.length;i++){
            updateBtn[i].onclick = function(){
              var ajax = ajaxObj("POST","response.php");
               ajax.onreadystatechange =function(){
                  if(ajaxReturn(ajax)){
                    mdalCont.innerHTML = ajax.responseText;
                    if(ajax.status==200){
                      var upNow = getId('upNow');
                      var upMsg = getId('upMsg');
                      var e_uname = getId('e_userName');
                      var e_pass = getId('e_pass');
                      var e_email = getId('e_email');
                      var togBox = getId('togBox');
                      togBox.onclick=function(){
                        togBox.checked ? e_pass.setAttribute('type','text') : e_pass.setAttribute('type','password');
                      }
                      upNow.onclick = function(){ 
                        if(emReg.test(e_email.value)){
                          var ajax = ajaxObj("POST","response.php");
                            ajax.onreadystatechange=function(){
                              if(ajaxReturn(ajax)){

                                upMsg.innerHTML = ajax.responseText;
                                a();
                              }
                            }
                            upMsg.innerHTML
                            ajax.send("setId="+this.value
                              +"&e_uname="+e_uname.value
                              +"&e_pass="+e_pass.value
                              +"&e_email="+e_email.value
                            )
                        }
                        else{
                          alert('PLS ENTER A VALID EMAIL');
                        }
                      }
                    }

                  }
               }
               mdalCont.innerHTML = "wait...";
               ajax.send("getOb="+this.value);
            }
          }
          var upNow = getId('upNow');


}
nxt();
</script>

</body>
</html>