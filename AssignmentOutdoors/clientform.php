<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Client Form Page</title>

   <?php
   include "header.php";
   ?>
        <script>
            //adds bootstrap class alert-error to the element, and adds to the to specified string
            function setError(element, message, errorString)
            {
                    element.classList.add("alert-danger");
                    errorString.innerHTML += "<li>" + message + "</li>";
             
            }
            
            //removes alert-danger bootstrap class from the specified element
            function unSetError(element)
            {
                    element.classList.remove("alert-danger");    
            }
            function validateMyForm()
            {

                //   Validate that the names are filled in, first and last name
//    Validate that they are letters, upper case and lower case. (You can use /^[a-zA-Z]+$/ as the regular expression)
//    Check to make sure the email is properly formatted using a regular expression.
//    Ensures the phone number is just numbers and formatted correctly for the database
//    If they are creating a new record make sure they filled the form out completely.
                let errorExists = false;
                let letterName = /^[a-zA-Z]+$/;
                let emailExpression = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                let passwordExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
                let phoneThreeDigits = /^\d{3}$/;
                let phoneFourDigits = /^\d{4}$/;
                let zipExpression = /^\d{5}$/;
                
                let errorList = document.getElementById("errorList");
                errorList.innerHTML = "";
                
                let firstName = document.getElementById("fname");
                let lastName = document.getElementById("lname");
                let emailAddress = document.getElementById("email");
                let password = document.getElementById("pword");
                let phone1 = document.getElementById("phone_1");
                let phone2 = document.getElementById("phone_2");
                let phone3 = document.getElementById("phone_3");
                let address = document.getElementById("address");
                let city = document.getElementById("city");
                let state = document.getElementById("state");
                let zip = document.getElementById("zip");
                let bday_1 = document.getElementById("bday_1");
                let bday_2 = document.getElementById("bday_2");
                let bday_3 = document.getElementById("bday_3");
                //check if first and last name filled in and there are only letters in the names
                if (firstName.value === "" || !firstName.value.match(letterName))
                {
                     setError(firstName, "Please enter first name, letters only", errorList);
                     errorExists = true;
                }
                else
                {
                    unSetError(firstName);

                }   
                               
                if (lastName.value === "" || !lastName.value.match(letterName))
                {
                  setError(lastName, "Please enter last name, letters only", errorList);
                  errorExists = true;

                }
                else
                {
                    unSetError(lastName);                
                }

                //check if email valid
                if (emailAddress.value === "" || !emailAddress.value.match(emailExpression))
                {
                    setError(emailAddress, "Please enter valid email address", errorList);
                    errorExists = true;

                }
                else
                {
                    unSetError(emailAddress);
                }

                //check if phone number valid
                if (!phone1.value.match(phoneThreeDigits))
                {
                   setError(phone1, "Invalid area code", errorList);
                   errorExists = true;

                }
                else
                {
                    unSetError(phone1);
                }
                if (!phone2.value.match(phoneThreeDigits))
                {
                    setError(phone2, "Please enter first three digits of phone number", errorList);
                    errorExists = true;

                }
                else
                {
                    unSetError(phone2);
                }
                if (!phone3.value.match(phoneFourDigits))
                {
                    setError(phone3, "Please enter last four digits of phone number", errorList);
                    errorExists = true;
                }
                else
                {
                    unSetError(phone3);
                }


                //if new record check if rest of form filled out
                
                if(!password.value.match(passwordExpression))
                {
                    passwordMessage = "Please enter valid password"
                    + "<ul><li>Have at least one uppercase letter</li>"
                    + "<li>Have at least one lowercase letter</li>"
                    + "<li>Have at least one special character</li>"
                    + "<li>Have at least one number</li>"
                    + "<li>Be 8 characters long</li></ul>";
                    
                    setError(password,passwordMessage , errorList);
                    errorExists = true;
                }
                else
                {
                    unSetError(password);
                }
                
                if(address.value  === "")
                {
                    setError(address, "Please enter address", errorList);
                    errorExists = true;
                }
                 else
                {
                    unSetError(address);
                }
                 if(city.value === "")
                {
                    setError(city, "Please enter city", errorList);
                    errorExists = true;
                }
                 else
                {
                    unSetError(city);
                }
                 if(state.value === "")
                {
                    setError(state, "Please enter state", errorList);
                    errorExists = true;
                }
                 else
                {
                    unSetError(state);
                }
                 if(!zip.value.match(zipExpression))
                {
                    setError(zip, "Please enter valid zip code", errorList);
                    errorExists = true;
                }
                 else
                {
                    unSetError(zip);
                }
                  if(!bday_1.value.match(/^\d{2}$/) || bday_1.value > 12 || bday_1.value < 1)
                {
                    setError(bday_1, "Please enter birthday month in mm format",errorList);
                    errorExists = true;
                }
                 else
                {
                    unSetError(bday_1);
                }
                 if(!bday_2.value.match(/^\d{2}$/) || bday_2.value < 0 || bday_2.value > 31)
                {
                    setError(bday_2, "Please enter birthday day in dd format", errorList);
                    errorExists = true;
                }
                 else
                {
                    unSetError(bday_2);
                }
                
                 if(!bday_3.value.match(/^\d{4}$/))
                {
                    setError(bday_3, "Please enter birthday year in yyyy format",errorList);
                    errorExists = true;
                }
                 else
                {
                    unSetError(bday_3);
                }
 
                if (errorExists === true)
                {
                    return false;
                }




            }

        </script>
  
       <div class="pageWrapper">
        <div id = "clientMain" class = "container ">
        <form id="form_11683" class="appnitro"  method="post" action="completed.php" onsubmit="return validateMyForm();">
            <div class="form_description">
                <h2>New Client</h2>
                <p>Sign up for our services</p>
            </div>						
            <ul >

                <li id="li_1" >
                    <label class="description" for="fname">First Name
                    </label>
                    <div>
                        <input id="fname" name="fname" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div> 
                </li>		
                <li id="li_2" >
                    <label class="description" for="lname">Last Name
                    </label>
                    <div>
                        <input id="lname" name="lname" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div> 
                </li>		
                <li id="li_3" >
                    <label class="description" for="email">E-mail
                    </label>
                    <div>
                        <input id="email" name="email" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div> 
                </li>		
                <li id="li_5" >
                    <label class="description" for="pword">Password
                    </label>
                    <div>
                        <input id="pword" name="pword" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div> 
                </li>	
                <li id="li_4" >
                    <label class="description" for="phone">Phone </label>
                    <span>
                        <input id="phone_1" name="phone_1" class="element text" size="3" maxlength="3" value="" type="text"> -
                        <label for="phone_1">(###)</label>
                    </span>
                    <span>
                        <input id="phone_2" name="phone_2" class="element text" size="3" maxlength="3" value="" type="text"> -
                        <label for="phone_2">###</label>
                    </span>
                    <span>
                        <input id="phone_3" name="phone_3" class="element text" size="4" maxlength="4" value="" type="text">
                        <label for="phone_3">####</label>
                    </span>
                </li>
                <li id="li_6" >
                    <label class="description" for="address">Street Address</label>
                    <div>
                        <input id="address" name="address" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div> 
                </li>		
                <li id="li_7" >
                    <label class="description" for="city">City</label>
                    <div>
                        <input id="city" name="city" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div> 
                </li>		
                <li id="li_10" >
                    <label class="description" for="state">State </label>
                    <div>
                        <select class="element select medium" id="state" name="state"> 
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                            <option value="MT">Montana</option>
                            <option value="NV">Nevada</option>
                            <option value="NM">New Mexico</option>
                            <option value="OR">Oregon</option>
                            <option value="UT">Utah</option>
                            <option value="WA">Washington</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div> 
                </li>		
                <li id="li_8" >
                    <label class="description" for="zip">Zip Code</label>
                    <div>
                        <input id="zip" name="zip" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div> 
                </li>		
                <li id="li_9" >
                    <label class="description" for="bday">Birthday</label>
                    <span>
                        <input id="bday_1" name="month" class="element text" size="2" maxlength="2" value="" type="text"> /
                        <label for="bday_1">MM</label>
                    </span>
                    <span>
                        <input id="bday_2" name="day" class="element text" size="2" maxlength="2" value="" type="text"> /
                        <label for="bday_2">DD</label>
                    </span>
                    <span>
                        <input id="bday_3" name="year" class="element text" size="4" maxlength="4" value="" type="text">
                        <label for="bday_3">YYYY</label>
                    </span>
                </li>
                <li class="buttons">
                    <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit"/>
                </li>
            </ul>

        </form>	
        <ul id="errorList"></ul>
        </div>
           <?php
           include "NavBar.php";
           ?>
       </div>
    </body>
</html>
