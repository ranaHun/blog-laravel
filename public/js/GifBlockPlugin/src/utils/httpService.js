export function getHttp(url){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "https://api.giphy.com/v1/gifs/search?api_key=DH4OAUoxUkZeGE7kOEq00I71CVNOshst&q=new-year&limit=2&offset=0&rating=g&lang=en");

    xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
        console.log(xhr.responseText);
    }};

    xhr.send();
}
export async function httpGetAsync(theUrl)
{
    return new Promise((resolve, reject)=>{
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() { 
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                resolve(JSON.parse(xmlHttp.responseText));
        }
        xmlHttp.open("GET", theUrl, true); // true for asynchronous 
        xmlHttp.send(null);
    });
}