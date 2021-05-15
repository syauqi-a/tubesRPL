function validation(){
	const password = document.querySelector('input[name=password]');
	const confirm = document.querySelector('input[name=confirm]');
	if (confirm.value === password.value)
		confirm.setCustomValidity('');
	else
		confirm.setCustomValidity('Passwords do not match');
}

$(document).ready(function(){
	$('#form_signup').on('submit', function(event){
		event.preventDefault();
		document.getElementById("msgUN").style.display = "none";
		document.getElementById("msgEmail").style.display = "none";
		var formData = $(this).serialize();
		$.ajax({
			url: 'processes/signup.php',
			method: 'POST',
			data: formData,
			success: function(data){
				if(data=="success"){
					alert("You have successfully registered");
					window.location = 'login.html';
				}
				else if(data=="error: username")
					document.getElementById("msgUN").style.display = "block";
				else if(data=="error: email")
					document.getElementById("msgEmail").style.display = "block";
			}
		});
	});
});