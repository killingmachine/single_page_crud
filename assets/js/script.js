var delBtn = document.getElementsByClassName("delBtn");
var delMsg = getId('delMsg');
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
    