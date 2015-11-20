$(document).ready(function(){
  		$('body').css("background-color","#CCCCCC");

//This section scans the user password and determines if there are any illegal words or phrases
		$( "#password" ).focusout(function(){
				//clears out error queue
				$("#errors").empty();

		    	var str = $( "#password" ).val();
		    	// Mimimum length requirement
		    	if( str.length < 8){
		    		$("#errors").append("Password must be at least 8 characters <br>");
		    	}

		    	strLow = str.toLowerCase(); 
		    	strHigh = str.toUpperCase();
		    	if(strLow == str){
		    		$("#errors").append("Password must contain at least one upper case character<br>");
		    	}
		    	else if(strHigh == str){
		    		$("#errors").append("Password must contain at least one lower case character<br>");
		    	}

		    	var sCharArr = ["!","#","$","%","&","'","(",")","*","+",",","-",".","/",":",";","<","=",">","?","@","[","]","^","_","{","|","}","~"];
		    	var sCharB = false;
		    	var strArr = str.split("");
		    	

				for(i = 0; i < sCharArr.length; i++){
					for(j = 0; j < strArr.length; j++)
						if(sCharArr[i] == strArr[j]){
							console.log(sCharArr[i] + " : " + strArr[j]);
							sCharB = true;
							break;
					};
				}
				if(sCharB == false){
					$("#errors").append("Password must contain at least one special character<br>");
				}

				for(i = 0; i < wordList.length; i++){
					var res = strLow.match(wordList[i]);
					if(res != null){
						console.log(res)
						$("#errors").append("You cannot use the phrase " + res + " in your password <br>");
						break;
					};
					
				}
//Prevents user from entering his name or alias as part of the registrLowation process				
				var inputList = [$( "#name" ).val().toLowerCase(),$( "#alias" ).val().toLowerCase()]
				for(i = 0; i < inputList.length; i++){
					var res = strLow.match(inputList[i]);
					if(res != null){
						console.log(res)
						$("#errors").append("You cannot use the phrase " + res + " in your password <br>");
						break;
					};
				
				}


		    });

			var wordList = ["123456","porsche","sunshine","solar","firebird","prince","rosebud","password","guitar","butter","beach","jaguar","12345678","chelsea","united","amateur","great","1234","black","turtle","7777777","cool","pussy","diamond","steelers","muffin","cooper","12345","nascar","tiffany","redsox","1313","dragon","jackson","zxcvbn","star","scorpio","qwerty","cameron","tomcat","testing","mountain","696969","654321","golf","shannon","madison","mustang","computer","bond007","murphy","987654"];	


			// $("#registration").click(function(){
			// 	var newValue = $("#password").val();
			// 	console.log(newValue);
			// 	$("#password").val(sha1(newValue));
			// 	console.log($("#password").val());

			// })	

			$("#loginreset").submit(function(event){
				// console.log($("#emailreset").val());
				event.preventDefault();
				$.post( "/users/question", { email: $("#emailreset").val()})
				  .done(function( data ) {
				  	$("#loginreset").hide();
				  	$("#questionForm").show();
				  	$("#resetQuestion").append(data);
				    console.log( "Data Loaded: " + data );
				});
			})

			$("#questionForm").submit(function(event){
				// console.log($("#emailreset").val());
				event.preventDefault();
				$.post( "/users/answer", { email: $("#emailreset").val(), answer:$("#answerreset").val()})
				  .done(function( data ) {
				  	$("#questionForm").hide();
				  	console.log( "Data Loaded: " + data );
				  	//do this if the answer qas correct
				  	if(data == 1){
					  	$("#emailMessage1").show();
					  	$("#answerForm").delay(2000).fadeIn(500);
				  	}
				  	//do this if the answer was incorrect
				  	else{
					  	$("#failure1").show();
				  	}
				});
			})

			$("#questionForm").submit(function(event){
				// console.log($("#emailreset").val());
				event.preventDefault();
				$.post( "/users/resetpassword", { email: $("#emailreset").val(), answer:$("#answerreset").val(), password:$("#password")})
				  .done(function( data ) {
				  	$("#questionForm").hide();
				  	console.log( "Data Loaded: " + data );
				});
			})
				
		});