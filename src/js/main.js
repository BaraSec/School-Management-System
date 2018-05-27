document.addEventListener("DOMContentLoaded", function (e)
{
	applyRequiredValidationsAndSubmissions();

	eventsNewsViewer();

	eventsNewsPages();

	signoutListener();

});

function signoutListener()
{
	_element = document.getElementById("signout");

	if(_element == null)
		return;

	_element.addEventListener('click', function (e)
	{
		e.preventDefault();

		signout();
	});
}

function eventsNewsPages()
{
	if(document.getElementById("maCont") == null)
		return;

	_maCont = document.getElementById("maCont").childNodes;

	Array.from(_maCont).forEach(_element => {

		if(_element.nodeName == "P" && _element.id != "expand" && _element.firstChild.innerHTML != undefined)
			_element.addEventListener('click', function (e)
			{
				let _content = '<br>&nbsp;* Details:<br><br>&nbsp;&nbsp;&nbsp;' + (_element.firstChild.getAttribute("value"));

				if(_content != document.getElementById("expand").innerHTML)
				{
					document.getElementById("expand").style.height="110px";
					document.getElementById("expand").innerHTML = '<br>&nbsp;* Details:<br><br>&nbsp;&nbsp;&nbsp;' + (_element.firstChild.getAttribute("value"));
				}
				else
				{
					document.getElementById("expand").style.height="0px";
					document.getElementById("expand").innerHTML = "";
				}
			});
	});
}

function eventsNewsViewer()
{
	_news = document.getElementById("news").childNodes;

	Array.from(_news).forEach(_element => {

		if(_element.nodeName == "P" && _element.id != "expandNews")
			_element.addEventListener('click', function (e)
			{
				let _content = '<br>&nbsp;* News Details:<br><br>&nbsp;&nbsp;&nbsp;' + (_element.firstChild.getAttribute("value"));

				if(_content != document.getElementById("expandNews").innerHTML)
				{
					document.getElementById("expandNews").style.height="110px";
					document.getElementById("expandNews").innerHTML = '<br>&nbsp;* News Details:<br><br>&nbsp;&nbsp;&nbsp;' + (_element.firstChild.getAttribute("value"));
				}
				else
				{
					document.getElementById("expandNews").style.height="0px";
					document.getElementById("expandNews").innerHTML = "";
				}
			});
	});

	_events = document.getElementById("events").childNodes;

	Array.from(_events).forEach(_element => {

		if(_element.nodeName == "P" && _element.id != "expandEvents")
			_element.addEventListener('click', function (e)
			{
				let _content = '<br>&nbsp;* Event Details:<br><br>&nbsp;&nbsp;&nbsp;' + (_element.firstChild.getAttribute("value"));

				if(_content != document.getElementById("expandEvents").innerHTML)
				{
					document.getElementById("expandEvents").style.height="110px";
					document.getElementById("expandEvents").innerHTML = '<br>&nbsp;* Event Details:<br><br>&nbsp;&nbsp;&nbsp;' + (_element.firstChild.getAttribute("value"));
				}
				else
				{
					document.getElementById("expandEvents").style.height="0px";
					document.getElementById("expandEvents").innerHTML = "";
				}
			});
	});
}

function applyRequiredValidationsAndSubmissions()
{
	if (document.getElementById("loginForm") != null)
	{
		let _form = document.getElementById("loginForm");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("username")) || isEmpty(document.getElementById("password")))
				alert("Enter your username and password please!");
			else
				signin();
			
		});
	}
	else if (document.getElementById("contactForm") != null)
	{
		let _form = document.getElementById("contactForm");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("name")) || isEmpty(document.getElementById("phone")) || isEmpty(document.getElementById("feedback")))
			{
				alert("Fill all the required fields please!");
				return;
			}
			else if (!isValidPhone(document.getElementById("phone")))
			{
				alert("Enter a valid 10 digit phone number please!");
				return;
			}
			else if (!isEmpty(document.getElementById("email")) && !isValidEmail(document.getElementById("email")))
			{
				alert("Enter a valid email address or keep it empty please!");
				return;
			}

			addFeedback();
		});
	}
	else if (document.getElementById("applyForm") != null)
	{
		let _form = document.getElementById("applyForm");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("first_name")) || isEmpty(document.getElementById("last_name")) || isEmpty(document.getElementById("gender")) || isEmpty(document.getElementById("dob")) ||
				isEmpty(document.getElementById("average")) || isEmpty(document.getElementById("interests")) || isEmpty(document.getElementById("father_name")) || isEmpty(document.getElementById("father_job")) ||
				isEmpty(document.getElementById("father_phone")) || isEmpty(document.getElementById("mother_name")) || isEmpty(document.getElementById("mother_job")) || isEmpty(document.getElementById("mother_phone"))
				|| isEmpty(document.getElementById("email")) || isEmpty(document.getElementById("parents_email")) || isEmpty(document.getElementById("payment")) || isEmpty(document.getElementById("grade")))
			{
				alert("Fill all the fields please!");
				return;
			}
			else if (document.getElementById("gender").value != "Male" && document.getElementById("gender").value != "Female")
			{
				alert("Choose a valid gender please!");
				return;
			}
			else if (!isValidDate(document.getElementById("dob")) || !isValidBirth(document.getElementById("dob")))
			{
				alert("Enter a valid date of birth please!");
				return;
			}
			else if (!isNumeric(document.getElementById("average")) || document.getElementById("average").value < 0)
			{
				alert("Enter a valid marks' average please!");
				return;
			}
			else if (!isValidPhone(document.getElementById("father_phone")) || !isValidPhone(document.getElementById("mother_phone")))
			{
				alert("Enter a valid 10 digit phone number please!");
				return;
			}
			else if (!isValidEmail(document.getElementById("email")) || !isValidEmail(document.getElementById("parents_email")))
			{
				alert("Enter valid email addresses please!");
				return;
			}
			else if(document.getElementById("grade").value > 12 || document.getElementById("grade").value < 7)
			{
				alert("We have grades {7 - 12} only!");
				return;
			}

			submitApplication();
		});
	}

	if(document.getElementById("events") != null && document.getElementById("news") != null)
	{
		loadEventsNews("events");
		loadEventsNews("news");
	}
	
	if(document.getElementById("addEventNewsForm") != null)
	{
		let _form = document.getElementById("addEventNewsForm");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("new_short_story")) || isEmpty(document.getElementById("new_full_story")) || isEmpty(document.getElementById("eventNewsType")))
			{
				alert("All fields are required to add an event/news!");
				return;
			}
			else if (document.getElementById("eventNewsType").value != "events" && document.getElementById("eventNewsType").value != "news")
			{
				alert("Choose either Events or News please!");
				return;
			}

			addEventNews();
		});
	}

	if(document.getElementById("updatePWform") != null)
	{
		let _form = document.getElementById("updatePWform");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("currPW")) || isEmpty(document.getElementById("newPW")) || isEmpty(document.getElementById("reNewPW")))
			{
				alert("All fields are required to update your password!");
				return;
			}
			else if (document.getElementById("newPW").value != document.getElementById("reNewPW").value)
			{
				alert("Passwords don't match!");

				document.getElementById("newPW").value = "";
				document.getElementById("reNewPW").value = "";

				return;
			}
			else if (!isValidPW(document.getElementById("newPW")))
			{
				alert("New password must be at least 9 characters long, having 1 uppercase letter, 1 lowercase letter, and 1 digit!");

				document.getElementById("reNewPW").value = "";
				document.getElementById("newPW").value = "";

				return;
			}

			updatePW();
		});
	}

	if(document.getElementById("removeTeacher") != null)
	{
		let _button = document.getElementById("removeTeacher");

		_button.addEventListener('click', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("teacherRM")))
			{
				alert("Choose a teacher to remove please!");
				return;
			}

			removeTeacher();
		});
	}

	if (document.getElementById("addRemoveTeachers") != null)
	{
		let _form = document.getElementById("addRemoveTeachers");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("newT_name")) || isEmpty(document.getElementById("newT_gender")) || isEmpty(document.getElementById("newT_dob")) || isEmpty(document.getElementById("newT_phone")) 
				|| isEmpty(document.getElementById("newT_email")) || isEmpty(document.getElementById("newT_ID")) || isEmpty(document.getElementById("newT_salary")) || isEmpty(document.getElementById("newT_password"))
				|| isEmpty(document.getElementById("newT_username")))
			{
				alert("Fill all the fields please!");
				return;
			}
			else if (document.getElementById("newT_gender").value != "Male" && document.getElementById("gender").value != "Female")
			{
				alert("Choose a valid gender please!");
				return;
			}
			else if (!isValidDate(document.getElementById("newT_dob")) || !isValidBirth(document.getElementById("newT_dob")))
			{
				alert("Enter a valid date of birth please!");
				return;
			}
			else if (!isValidPhone(document.getElementById("newT_phone")))
			{
				alert("Enter a valid 10 digit phone number please!");
				return;
			}
			else if (!isValidEmail(document.getElementById("newT_email")))
			{
				alert("Enter a valid email address please!");
				return;
			}
			else if(document.getElementById("newT_ID").value.length < 10 || !isNumeric(document.getElementById("newT_ID")))
			{
				alert("Enter a valid 10 digit ID please!");
				return;
			}
			else if(!isNumeric(document.getElementById("newT_salary")) || document.getElementById("newT_salary").value < 0)
			{
				alert("Enter a valid salary please!");
				return;
			}
			else if(!isValidPW(document.getElementById("newT_password")))
			{
				alert("Password must be at least 9 characters long, having 1 uppercase letter, 1 lowercase letter, and 1 digit!");
				document.getElementById("newT_password").value = "";

				return;
			}
			else if(!isValidUsername(document.getElementById("newT_username")))
			{
				alert("Username must be at least 7 characters long, having 1 uppercase letter, 1 lowercase letter, and 1 digit!");
				document.getElementById("newT_username").value = "";

				return;
			}

			addTeacher();
		});
	}

	if(document.getElementById("addSec") != null)
	{
		let _button = document.getElementById("addSec");

		_button.addEventListener('click', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("add_section_to")))
			{
				alert("Choose a grade to add a section to please!");
				return;
			}

			addSection(document.getElementById("add_section_to").value);
		});
	}

	if(document.getElementById("delSec") != null)
	{
		let _button = document.getElementById("delSec");

		_button.addEventListener('click', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("del_from_grade")) || isEmpty(document.getElementById("del_section")))
			{
				alert("Choose both fields please!");
				return;
			}

			delSection(document.getElementById("del_from_grade").value, document.getElementById("del_section").value);
		});
	}

	if(document.getElementById("del_from_grade") != null)
	{
		let _element = document.getElementById("del_from_grade");

		_element.addEventListener('change', function (e)
		{
			e.preventDefault();

			let _element = document.getElementById("del_from_grade");

			document.getElementById("del_section").innerHTML = "";

			if(!isEmpty(_element))
				loadSections(document.getElementById("del_section"), document.getElementById("del_from_grade").value);
		});
	}

	if(document.getElementById("movStd") != null)
	{
		let _form = document.getElementById("movStd");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("std_to_mov")) || isEmpty(document.getElementById("mov_to_section")))
			{
				alert("Choose both fields please!");
				return;
			}

			movStd();
		});
	}

	if(document.getElementById("std_to_mov") != null)
	{
		let _element = document.getElementById("std_to_mov");

		_element.addEventListener('change', function (e)
		{
			e.preventDefault();

			let _element = document.getElementById("std_to_mov");

			document.getElementById("mov_to_section").innerHTML = "";

			if(!isEmpty(_element))
				loadSections(document.getElementById("mov_to_section"), document.getElementById("std_to_mov").options[document.getElementById("std_to_mov").selectedIndex].innerHTML.split("Grade: ")[1][0]);
		});
	}

	if(document.getElementById("updateSched") != null)
	{
		let _form = document.getElementById("updateSched");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("updGrade")) || isEmpty(document.getElementById("updSec")) || isEmpty(document.getElementById("updLec")) || isEmpty(document.getElementById("updSub"))
				|| isEmpty(document.getElementById("updTeacher")))
			{
				alert("Choose all fields please!");
				return;
			}

			updateSched();
		});
	}

	if(document.getElementById("updGrade") != null)
	{
		let _element = document.getElementById("updGrade");

		_element.addEventListener('change', function (e)
		{
			e.preventDefault();

			let _element = document.getElementById("updGrade");

			document.getElementById("updSec").innerHTML = "";

			if(!isEmpty(_element))
				loadSections(document.getElementById("updSec"), document.getElementById("updGrade").value);
		});
	}

	
	if(document.getElementById("StdtoView") != null)
	{
		let _element = document.getElementById("StdtoView");

		_element.addEventListener('change', function (e)
		{
			e.preventDefault();

			let _element = document.getElementById("StdtoView");

			document.getElementById("stdInfo").innerHTML = "";

			if(!isEmpty(_element))
				loadStdInfo(document.getElementById("StdtoView").value, document.getElementById("stdInfo"));
		});
	}

	if(document.getElementById("mGrade") != null)
	{
		let _element = document.getElementById("mGrade");

		_element.addEventListener('change', function (e)
		{
			e.preventDefault();

			let _element = document.getElementById("mGrade");

			document.getElementById("mSec").innerHTML = "<option selected></option>";
			document.getElementById("mSub").innerHTML = "<option selected></option>";
			document.getElementById("stds").innerHTML = "";

			if(!isEmpty(_element))
				loadSectionsStrict(document.getElementById("mSec"), document.getElementById("mGrade").value);
		});
	}

	if(document.getElementById("mSec") != null)
	{
		let _element = document.getElementById("mSec");

		_element.addEventListener('change', function (e)
		{
			e.preventDefault();

			let _element = document.getElementById("mSec");

			document.getElementById("mSub").innerHTML = "<option selected></option>";
			document.getElementById("stds").innerHTML = "";

			if(!isEmpty(_element))
				loadSubjectsStrict(document.getElementById("mSub"), document.getElementById("mGrade").value, document.getElementById("mSec").value);
		});
	}

	if(document.getElementById("mSub") != null)
	{
		let _element = document.getElementById("mSub");

		_element.addEventListener('change', function (e)
		{
			e.preventDefault();

			let _element = document.getElementById("mSub");

			document.getElementById("stds").innerHTML = "";

			if(!isEmpty(_element))
				loadStudentsM(document.getElementById("stds"));
		});
	}

	if(document.getElementById("addM") != null)
	{
		let _form = document.getElementById("addM");

		_form.addEventListener('submit', function (e)
		{
			e.preventDefault();

			if (isEmpty(document.getElementById("mSub")) || isEmpty(document.getElementById("mSec")) || isEmpty(document.getElementById("mGrade")) || isEmpty(document.getElementById("mName")))
			{
				alert("Fill all fields please!");
				return;
			}

			addMarks();
			addMarks_Students();
		});
	}
}

function isValidUsername(_element)
{
	return _element.value.length > 6 && hasLowerCase(_element.value) && hasUpperCase(_element.value) && hasNumber(_element.value);
}

function isValidPW(_element)
{
	if(_element.value.length < 9 || !hasLowerCase(_element.value) || !hasUpperCase(_element.value) || !hasNumber(_element.value))
		return false;

	return true;
}

function hasNumber(str) 
{
 	return /\d/.test(str);
}

function hasLowerCase(str)
{
    return str.toUpperCase() != str;
}

function hasUpperCase(str)
{
    return str.toLowerCase() != str;
}

function isEmpty(_element)
{
	if (_element.value == "" || _element.value == null)
		return true;

	return false;
}

function isValidPhone(_phone)
{
	if (_phone.value.match(/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/))
		return true;

	return false;
}

function isValidEmail(_email)
{
	let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	return re.test(_email.value);
}

function isValidDate(_date)
{
	let dateString = _date.value;

	// First check for the pattern
	if (!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(dateString))
		return false;

	// Parse the date parts to integers
	let parts = dateString.split("-");
	let day = parseInt(parts[2], 10);
	let month = parseInt(parts[1], 10);
	let year = parseInt(parts[0], 10);

	// Check the ranges of month and year
	if (year < 1000 || year > 3000 || month == 0 || month > 12)
		return false;

	let monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

	// Adjust for leap years
	if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
		monthLength[1] = 29;

	// Check the range of the day
	return day > 0 && day <= monthLength[month - 1];
}

function isValidBirth(_date)
{
	let today = new Date();
	let dd = today.getDate();
	let mm = today.getMonth() + 1;
	let yyyy = today.getFullYear();

	if (dd < 10)
		dd = '0' + dd

	if (mm < 10)
		mm = '0' + mm

	let dateString = _date.value;
	let parts = dateString.split("-");
	let day = parseInt(parts[2], 10);
	let month = parseInt(parts[1], 10);
	let year = parseInt(parts[0], 10);

	if (year > yyyy || (year == yyyy && month > mm) || (year == yyyy && month == mm && day > dd))
		return false;

	return true;
}

function isNumeric(_num)
{
	return !isNaN(parseFloat(_num.value)) && isFinite(_num.value);
}