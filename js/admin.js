// const original = document.getElementById("page").innerHTML
// console.log(original)
function loadoldContent(){
    var divContent = document.getElementById("page");
    divContent.innerHTML = original
}
function loadoldContentx(pagename){
    var divContent = document.getElementById("page");
    divContent.innerHTML = original
    getcontent(pagename)
}
function getContent(pagename) {
    var divContent = document.getElementById("page");
    divContent.innerHTML = loadPage(pagename);
}
function loadPage(href)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", href, false);
    xmlhttp.send();
    return xmlhttp.responseText;
}
