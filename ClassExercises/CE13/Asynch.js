//get xml http request.  check for the different browsers to adjust for the correct
//http request method
function AJAXRequest(){
    
    try{
        http_request = new XMLHttpRequest();
        
    }
    catch(e)
    {
        try{
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try{
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                //something went wrong, can't identify browser
                alert("Your Browser Broke!");
                return false;
            }
        }
    }
    return http_request;
    
}

