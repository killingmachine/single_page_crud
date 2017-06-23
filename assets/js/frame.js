function getId(id){
	return document.getElementById(id);
}
function getFrmOb(frm, frmObj){
	return document.forms[frm][frmObj];
}
function ajaxObj(meth,path){
    var x = new XMLHttpRequest();
    x.open(meth, path, true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    return x;
};
function ajaxReturn(x){
     if(x.readyState == 4 && x.status == 200) {
           return true;
        }
};
