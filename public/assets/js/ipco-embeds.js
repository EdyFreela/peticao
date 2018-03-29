var peticao = document.getElementById('ipco-embed-petition');
var id = peticao.dataset.id;

var makeIframe = document.createElement("iframe");
makeIframe.setAttribute("src", "https://campanhas.ipco.org.br/embed/" + id);
makeIframe.setAttribute("scrolling", "no");
makeIframe.style.border = "none";
makeIframe.style.left =  "0px";
makeIframe.style.top = "0px";
makeIframe.style.position = "relative";
makeIframe.style.width = "300px";
makeIframe.style.height = "450px";
makeIframe.style.display = "block";
makeIframe.style.margin = "auto";
makeIframe.style.border = "1px solid #eee";

var getRef = document.getElementById("ipco-embed-petition");
var parentDiv = getRef.parentNode;
parentDiv.insertBefore(makeIframe, getRef);