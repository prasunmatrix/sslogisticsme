/*****************************************************/
    // Function name : getKeyCode
    // Functionality: get key code
    // Author : Sanchari Ghosh                               
    // Created Date : 29/08/2018                                          
    // Purpose:  Developing the functionality of getting keycode of input field
/*****************************************************/
function getKeyCode(e) {
	if (window.event) {
		return window.event.keyCode;
	} else if (e) {
		return e.which;
	} else {
		return null;
	}
}



/*****************************************************/
    // Function name : keyRestrict
    // Functionality: restrict to specific key
    // Author : Sanchari Ghosh                               
    // Created Date : 29/08/2018                                          
    // Purpose:  Developing the functionality of allowing user to type only some specific key
/*****************************************************/
function keyRestrict(e, validchars) 
{
	var key='', keychar='';
	key = getKeyCode(e);
	if (key == null) {
		return true;
	}
	keychar = String.fromCharCode(key);
	keychar = keychar.toLowerCase();
	validchars = validchars.toLowerCase();
	if (validchars.indexOf(keychar) != -1) {
		return true;
	}
	if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 ) {
		return true;
	}
	return false;
}


/*****************************************************/
    // Function name : emailCheck
    // Functionality: email validation
    // Author : Sanchari Ghosh                               
    // Created Date : 29/08/2018                                          
    // Purpose:  Developing the functionality of email validation
/*****************************************************/
function emailCheck(entry) {
    if ((/^[a-zA-Z0-9-._+]+(@[a-zA-Z0-9-.]{1,}[a-zA-Z0-9_.-]+\.)+[a-zA-Z]{2,4}$/).exec(entry) == null)	{
        return false;
    }
    return true;
}