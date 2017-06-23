 function a(){
        var ajax = ajaxObj("POST","response.php");
        ajax.onreadystatechange =function(){
          if(ajaxReturn(ajax)){
              tbody.innerHTML = ajax.responseText; 
              // showLodMore();
              re_run();
           }

        }
        tbody.innerHTML = 'wait....';
        ajax.send("upTable="+ rpp);
      }
function addZero(a,b){
          if(a<10){
                b = "" +0+a;
              }
              else{
                b = a;
              } 
              return b;
}
// function showLodMore(){
//   if(rpp < rowCount){
//      paginate.style.display = "inline-block";
//   }
//   else{
//      paginate.style.display = "none";
//   }  
// }

