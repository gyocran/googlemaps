(function() {
	// document.addEventListener('deviceready', onDeviceReady.bind(this), false);
	// document.getElementById("loginbutton").addEventListener("click",
		// login());
		// function onDeviceReady() {
	document.getElementById("loginbutton").addEventListener("click",login);
	document.getElementById("newUser").addEventListener("click",
		registerUser);
	document.getElementById("getusers").addEventListener("click",
		getUsers);
	document.getElementById("refresh").addEventListener("click",
		reload);
	// };
	
	function login(){
            var username = $("#username").val();
            var password = $("#password").val();
			// console.log(password);
                // if (!validateUsername(username))
                // {
                    // return;
                // }
                var url = "login_ajax.php?cmd=3&username=" + username + "&pword=" + password;
                $.ajax(url,
                        {
                            async: true, complete: loginComplete
                        });
            }
	  	
		function loginComplete(xhr, status)
            {
                if (status != "success")
                {
                    alert("Invalid Login");
                }

                var log = $.parseJSON(xhr.responseText);
                if (log.result == 0)
                {
                    errorMsg.innerHTML = log.message;
                }
                else if(log.user_type == 'Admin')
                {
					// user_id = log.user_id;
					// console.log(log.user_type);
					document.getElementById("adminname").innerHTML = log.user_firstname;
                    location.href = "#adminpage";
					return;
                }
				else if(log.user_status == 'Disabled')
                {
					// user_id = log.user_id;
					// console.log(log.user_type);
					// document.getElementById("adminname").innerHTML = log.user_firstname;
                    location.href = "#disableduser";
					return;
                }
				else if(log.user_type == 'Guest')
                {
					// user_id = log.user_id;
					console.log(log.user_type);
                    location.href = "#mappage";
					return;
                }
            }
			
			function registerUser(){
				alert("register entered");
				// var user_id = user_id;
				var username = $("#reg_username").val();
				var firstname = $("#reg_firstname").val();
				var lastname = $("#reg_lastname").val();
				var telephone = $("#reg_telephone").val();
				var pass = $("#reg_password").val();
				console.log(username);
				console.log(firstname);
				console.log(lastname);
				console.log(telephone);
				console.log(pass);
                var url = "register_ajax.php?cmd=3&username="+username+"&firstname="+firstname+"&lastname="+lastname+"&telephone="+telephone+"&password="+pass;
                $.ajax(url,
                        {
						      async: true, complete: registerUserComplete
                        });
           }
		   
		   function registerUserComplete(xhr,status){
			   var newUser = $.parseJSON(xhr.responseText);
		if (newUser.result===0)
                {
                    alert("failed to add new user");
					return;
                }
				else if(newUser.result===1)
					console.log(newUser.message);
				console.log(newUser.sms);
			    alert("Congratulations! You have been added");
				// location.href = "#landingpage";
	}
	
	function getUsers(){
				// alert("get users entered");
				// var user_id = user_id;
                var url = "admin_ajax.php?cmd=0";
                $.ajax(url,
                        {
						      async: true, complete: getUsersComplete
                        });
           }
		   
			
	function getUsersComplete(xhr, status)
            {
                if (status != "success")
                {
                    alert("Failed to get users");
                }

                var users = $.parseJSON(xhr.responseText);
                if (users == false)
                {
                    alert("Failed to get users");
                }
                else {
					console.log(users);
					
					// var i = document.getElementById("userstable").innerHTML;
					// alert("getting users");
					// alert(i);
					
					$("#userstable thead").html("");
					var dataHeader = "<tr>" + "<th id='col-userId'>" + "User ID" + "</th>" + "<th id='col-username'>" + "Username" + "</th>" + "<th id='col-firstname'>" + 
					 "Firstname" + "</th>" + "<th id='col-lastname'>" + "Lastname" + "</th>" + "<th id='col-telephone'>" + "Telephone Number" + "</th>" +
					"<th id='col-type'>" + "Type" + "</th>"+"<th id='col-status'>" + "User Status" + "</th>"+
					"<th>" + " " + "</th>"+ "</tr>";
					$(dataHeader).appendTo("#userstable thead");
					
					// printing the table data
					$("#userstable tbody").html("");
					console.log(users.user[0].firstname);
					for(i=0; i< users.user.length; i++){
						// var id = users.user[i].firstname;
						// console.log("ooo");
						// $id = users.user[i].id;
						// console.log("id "+ $id);
					var data = "<tr id="+users.user[i].id+">"+ "<td>" + users.user[i].id + "</td>" + "<td>"+ users.user[i].username+ "</td>" +
					"<td>"+users.user[i].firstname+ "</td>" + "<td>" + users.user[i].lastname + "</td>" +
					"<td>"+ users.user[i].telephone + "</td>" + "<td>" +
					users.user[i].type + "</td>" + 
					"<td>"+ users.user[i].status + "</td>" + 
					"</tr>";
					$(data).appendTo("#userstable tbody");
				}
				// var x = document.getElementsByClassName[i]("disablebtn");
				// console.log(x);
				// console.log(x.name);
				// x.addEventListener("click",disableUser);
            }
			}
			
		function disableUser(){
				// alert("disable user entered");
				// var user_id = user_id;
                var url = "admin_ajax.php?cmd=1";
                $.ajax(url,
                        {
						      async: true, complete: getUsersComplete
                        });
           }
			
		function disableUser(){
			alert("works");
		}
		
		function reload(){
			location.reload();
		};
})();

