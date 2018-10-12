onload=start;
var s,e,x,y,z,t,f,h,w,o,fx="",d="";
function start()
{
    alert("Enter a function of x and click Plot to obtain the graph of the function\n")
    h=window.innerHeight;
    h+=10;
    document.getElementsByTagName("body")[0].style.backgroundSize="0px 0px";
    w=window.innerWidth;
    o=document.getElementById("function");
    o.innerHTML="f(x)="+d;
}
function display(c)
{
    switch(c)
    {
        case 'p':
        fx+="Math.pow(";
        d+="pow(";
        break;
        case 's':
        fx+="Math.sin(";
        d+="sin(";
        break;
        case 'c':
        fx+="Math.cos(";
        d+="cos(";
        break;
        case 'l':
        fx+="Math.log10(";
        d+="log(";
        break;
        case 'a':
        fx+="Math.abs(";
        d+="abs(";
        break;
        default:
        fx+=c;
        d+=c;
    }
    o.innerHTML="f(x)="+d;
}
function init()
{
    o.style.fontSize="100%";
    o.style.background="white";
    o.style.display="inline";
    document.getElementById("x").style.visibility="visible";
    document.getElementById("y").style.visibility="visible";
    document.getElementsByTagName("body")[0].style.backgroundSize="10px 10px";   document.getElementById("keys").style.display="none";
    document.getElementById("function").style.border="none";
    s=document.getElementsByTagName("svg")[0];
    s.setAttribute("width",w);
    s.style.position="absolute";
    s.style.height="100vh";
    f=document.createElementNS("http://www.w3.org/2000/svg","path");
    f.setAttribute("d","M "+eval(w/2)+" "+h+" L "+eval(w/2)+" "+0);
    f.style.stroke="black";
    f.style.strokeWidth="2px";
    f.style.fill="none";
    s.appendChild(f);
    f=document.createElementNS("http://www.w3.org/2000/svg","path");
    f.setAttribute("d","M "+0+" "+eval(h/2)+" L "+w+" "+eval(h/2));
    f.style.stroke="black";
    f.style.strokeWidth="2px";
    f.style.fill="none";
    s.appendChild(f);
    try
    {
        x=-w/20;
        y=eval(fx);
    }
    catch(err)
    {
        try
        {
            x=0.1
            y=eval(fx);
        }
        catch(err)
        {
            alert(err);
            return;
        }
    }
    t=setInterval(main,5);
}
function main()
{
    x0=x;
    x+=0.1;
    y0=y;
    y=eval(fx);
    if(isNaN(y)||isNaN(y0)||(y>h))
    {
        return;
    } f=document.createElementNS("http://www.w3.org/2000/svg","path");
    f.setAttribute("d","M "+eval(x0*10+w/2)+" "+eval(y0*10+h/2)+" L "+eval(x*10+w/2)+" "+eval(y*10+h/2));
    f.style.stroke="red";
    f.style.strokeWidth="2px";
    f.style.fill="none";
    s.appendChild(f);
    if(x>=w/2)
    {
        clearInterval(t);
    }
}
function allclear()
{
    fx="";
    d="";
    o.innerHTML="f(x)="+d;
}