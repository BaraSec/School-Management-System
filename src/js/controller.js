function signin()
{
    let username = $("#username").val();
    let password = $("#password").val();

    let jsonO = {'username': username, 'password': password};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "signin"},

        success: function(result) 
        {
            if(result == "Your credentials are Invalid!")
            {   
                $("#error").removeAttr("hidden");
                $("#error").text(result);
            }
            else
                window.location.href = result;
        }
    }); 
}

function signout()
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {key: "signout"},

        success: function(result) 
        {
            window.location.href = "signin.php";
        }
    }); 
}

function addFeedback()
{
    let name = $("#name").val();
    let phone = $("#phone").val();
    let email = $("#email").val();
    let feedback = $("#feedback").val();

    let jsonO = {'name': name, 'phone': phone, 'email': email, 'feedback': feedback};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "addFeedback"},

        success: function(result)
        {
            alert("Thanks for contacting us!");

            location.reload(); 
        }
    }); 
}

function submitApplication()
{
    let first_name = $("#first_name").val();
    let last_name = $("#last_name").val();
    let gender = $("#gender").val();
    let average = $("#average").val();
    let email = $("#email").val();
    let interests = $("#interests").val();
    let father_name = $("#father_name").val();
    let father_job = $("#father_job").val();
    let father_phone = $("#father_phone").val();
    let mother_name = $("#mother_name").val();
    let mother_job = $("#mother_job").val();
    let mother_phone = $("#mother_phone").val();
    let payment = $("#payment").val();
    let parents_email = $("#parents_email").val();

    let jsonO = {'first_name': first_name, 'last_name': last_name, 'gender': gender, 'average': average, 'email': email, 'interests': interests, 'father_name': father_name, 'father_job': father_job, 'father_phone': father_phone, 'mother_name': mother_name, 'mother_job': mother_job, 'mother_phone': mother_phone, 'payment': payment, 'parents_email': parents_email};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "submitApplication"},

        success: function(result)
        {
            alert("Thanks for applying to us! We will get in touch with you soon!");

            location.reload(); 
        }
    }); 
}

function addEventNews()
{
    let new_short_story = $("#new_short_story").val();
    let new_full_story = $("#new_full_story").val();
    let eventNewsType = $("#eventNewsType").val();

    let jsonO = {'new_short_story': new_short_story, 'new_full_story': new_full_story, 'eventNewsType': eventNewsType};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "addEventNews"},

        success: function(result)
        {
            alert("A new \"" + eventNewsType + "\" has been added!");

            $("#new_short_story").val(' ');
            $("#new_full_story").val(' ');
            $("#eventNewsType").val($("#eventNewsType option:first").val());

            loadEventsNews("events");
            loadEventsNews("news");
        }
    }); 
}

function loadEventsNews(_target)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {target: _target, key: "loadEventsNews"},

        success: function(result)
        {
            _result = jQuery.parseJSON(result);
            _elements = document.getElementById(_target).childNodes;

            let _index = 0;

            Array.from(_elements).forEach(_element => {

                if(_element.nodeName == "P" && _element.id.toLowerCase() != "expand" + _target)
                {
                    _element.firstChild.innerHTML = _result[_index]['short_story'];
                    _element.firstChild.setAttribute("value", _result[_index]['full_story']);

                    _index++;
                }
            });
        }
    }); 
}

function updatePW()
{
    let currPW = $("#currPW").val();
    let newPW = $("#newPW").val();

    let jsonO = {'currPW': currPW, 'newPW': newPW};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "updatePW"},

        success: function(result)
        {
           if(result == "Wrong current password!")
            {
                alert(result);
                $("#currPW").val('');

                return;
            }

            alert("Your password has been updated successfully! Signin again please.");

            signout();
        }
    }); 
}

function removeTeacher()
{
    let teacherRM = $("#teacherRM").val();

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {_teacherRM: teacherRM, key: "removeTeacher"},

        success: function(result)
        {
           if(result == "Invalid Teacher!")
            {
                alert(result);
                $("#teacherRM").val($("#teacherRM option:first").val());

                return;
            }

            alert("Teacher has been removed successfully!");

            location.reload(); 
        }
    }); 
}

function addTeacher()
{
    let newT_name = $("#newT_name").val();
    let newT_gender = $("#newT_gender").val();
    let newT_dob = $("#newT_dob").val();
    let newT_phone = $("#newT_phone").val();
    let newT_email = $("#newT_email").val();
    let newT_ID = $("#newT_ID").val();
    let newT_salary = $("#newT_salary").val();
    let newT_password = $("#newT_password").val();
    let newT_username = $("#newT_username").val();

    let jsonO = {'newT_name': newT_name, 'newT_gender': newT_gender, 'newT_dob': newT_dob, 'newT_phone': newT_phone, 'newT_email': newT_email, 'newT_ID': newT_ID, 'newT_salary': newT_salary, 'newT_password': newT_password, 'newT_username': newT_username};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "addTeacher"},

        success: function(result)
        {
            if(result == "Teacher with this ID already exists!")
            {
                alert(result);
                $("#newT_ID").val('');

                return;
            }
            else if(result == "Account with this username already exists! Enter another please!")
            {
                alert(result);
                $("#newT_username").val('');

                return;
            }

            alert("A new teacher has been added successfully!");

            location.reload(); 
        }
    }); 
}

function addSection(_grade)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {grade: _grade, key: "addSection"},

        success: function(result) 
        {
            alert("New secton to grade " + _grade + " has been added!");

            location.reload();
        }
    }); 
}

function loadSections(_element, _grade)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {grade: _grade, key: "getSections"},

        success: function(result) 
        {
            let _result = jQuery.parseJSON(result);

            for(let i = 0; i < _result.length; i++)
                _element.innerHTML += '<option value="' + _result[i]['section_number'] + '">' + _result[i]['section_number'] + '</option>';
        }
    }); 
}

function loadSectionsStrict(_element, _grade)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {grade: _grade, key: "getSectionsStrict"},

        success: function(result) 
        {
            let _result = jQuery.parseJSON(result);

            for(let i = 0; i < _result.length; i++)
                _element.innerHTML += '<option value="' + _result[i]['section'] + '">' + _result[i]['section'] + '</option>';
        }
    }); 
}

function loadSubjectsStrict(_element, _grade, _section)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {grade: _grade, section:_section, key: "getSubjectsStrict"},

        success: function(result) 
        {
            let _result = jQuery.parseJSON(result);

            for(let i = 0; i < _result.length; i++)
                _element.innerHTML += '<option value="' + _result[i] + '">' + _result[i] + '</option>';
        }
    }); 
}

function delSection(_grade, _section)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {grade: _grade, section: _section, key: "delSection"},

        success: function(result) 
        {
            if(result == "Grade or that section for the specified grade doesn't exist!")
            {
                alert(result);

                return;
            }

            alert("Deleted successfully!");

            location.reload(); 
        }
    }); 
}

function movStd()
{
    let std_to_mov = $("#std_to_mov").val();
    let mov_to_section = $("#mov_to_section").val();

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {sID: std_to_mov, section: mov_to_section, key: "movStd"},

        success: function(result) 
        {
            alert("Moved successfully!");

            location.reload(); 
        }
    }); 
}

function rejectAppl(_id)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {id:_id, key: "reject"},

        success: function(result) 
        {
            alert("Rejected!");

            location.reload(); 
        }
    }); 
}

function acceptAppl(_id)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {id:_id, key: "accept"},

        success: function(result) 
        {
            alert("Accepted! New student account has been created with username and password:\n\n\n" + result);

            location.reload(); 
        }
    }); 
}

function updateSched()
{
    let updGrade = $("#updGrade").val();
    let updSec = $("#updSec").val();
    let updLec = $("#updLec").val();
    let updSub = $("#updSub").val();
    let updTeacher = $("#updTeacher").val();

    let jsonO = {'updGrade': updGrade, 'updSec': updSec, 'updLec': updLec, 'updSub': updSub, 'updTeacher': updTeacher};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "updateSched"},

        success: function(result) 
        {
            alert("Updated successfully!");

            $("#updGrade").val($("#updGrade option:first").val());
            $("#updSec").val('');
            $("#updLec").val($("#updLec option:first").val());
            $("#updSub").val('');
            $("#updTeacher").val($("#updTeacher option:first").val());
        }
    }); 
}

function loadStdInfo(_sID, _targetElement)
{
    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {sID: _sID, key: "loadStdInfo"},

        success: function(result) 
        {
            let data = jQuery.parseJSON(result);

            _targetElement.innerHTML += `<br><table cellpadding=8 border=1 align="center"><tr bgcolor="#ffe2e4"><th>First Name</th>
                <th>Last Name</th>
                <th>Father Name</td>
                <th>Father Job</th>
                <th>Father Phone</th>
                <th>Mother Name</th>
                <th>Mother Job</th>
                <th>Mother Phone</th>
                <th>Grade</th>
                <th>Section</th>
                <th>Email</th>
                <th>Parents Email</th>
                <th>Username</th></tr>
                <tr>
                <td>`+ data[0]['first_name'] + `</td>
                <td>`+ data[0]['last_name'] + `</td>
                <td>`+ data[0]['father_name'] + `</td>
                <td>`+ data[0]['father_job'] + `</td>
                <td>`+ data[0]['father_phone'] + `</td>
                <td>`+ data[0]['mother_name'] + `</td>
                <td>`+ data[0]['mother_job'] + `</td>
                <td>`+ data[0]['mother_phone'] + `</td>
                <td>`+ data[0]['grade'] + `</td>
                <td>`+ data[0]['section'] + `</td>
                <td>`+ data[0]['email'] + `</td>
                <td>`+ data[0]['parents_email'] + `</td>
                <td>`+ data[0]['username'] + `</td>
                </tr>
                </table>
            `;
        }
    }); 
}

function loadStudentsM(_element)
{
    let mGrade = $("#mGrade").val();
    let mSec = $("#mSec").val();

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {grade: mGrade, section: mSec, key: "loadStudentsM"},

        success: function(result) 
        {
            let _result = jQuery.parseJSON(result);

            _element.innerHTML += '<br>';

            for(let i = 0; i < _result.length; i++)
            {
                _element.innerHTML += '<label style="padding:15px" value="' + _result[i]['sID'] + '">' + (i+1) + ". " +_result[i]['first_name'] + " " + _result[i]['last_name'] + '</label>'; 
                _element.innerHTML += '<input type="number" step="0.01" id="mark_' + _result[i]['sID'] + '"><br><br>'
            }
        }
    });   
}

function addMarks()
{
    let mName = $("#mName").val();
    let mGrade = $("#mGrade").val();
    let mSec = $("#mSec").val();
    let mSub = $("#mSub").val();

    let jsonO = {'mName': mName, 'mGrade': mGrade, 'mSec': mSec, 'mSub': mSub};
    let encoded = JSON.stringify(jsonO);

    $.ajax ({
        type: "POST",
        url: "php/controller.php",
        data: {obj: encoded, key: "addMarks"},

        success: function(result) 
        {
        }
    }); 
}

function addMarks_Students()
{
    let nodes = document.getElementById("stds").childNodes;

    for(i = 0; i < nodes.length; i++)
    {
        if(nodes[i].nodeName == "INPUT")
        {
            let sID = nodes[i].id.split("mark_")[1];
            let mark = nodes[i].value;

            $.ajax ({
                type: "POST",
                url: "php/controller.php",
                data: {sID: sID, mark: mark, key: "addMarks_Students"},

                success: function(result) 
                {
                }
            }); 
        }
    }

    alert("Added successfully");

    $("#mGrade").val($("#mGrade option:first").val());
    $("#mName").val('');
    document.getElementById("mSec").innerHTML = "<option selected></option>";
    document.getElementById("mSub").innerHTML = "<option selected></option>";
    document.getElementById("stds").innerHTML = "";
}