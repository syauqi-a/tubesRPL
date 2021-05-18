// show pop up background
showPopup = () => {
	document.getElementById("popup-bg").style.display = "flex";
	document.getElementById("popup-wrap-content").style.display = "block";
};

// close pop up background
closePopup = () => {
	document.getElementById("popup-bg").style.display = "none";
	document.getElementById("popup-wrap-content").style.display = "none";
};

// Change pop up content
changePopUpCtn = (newItem) => {
	var elm = document.getElementById("popup-content");
	// removing everything inside the node
	while(elm.firstChild)
		elm.removeChild(elm.firstChild);
	// appending new node
	elm.appendChild(document.createElement("null"));
	if(newItem) elm.innerHTML = newItem;
}

// Show success icon on pop up
showSuccess = (msg = "Success") => changePopUpCtn("<div style='text-align: center; margin: 24px;'><button type='button' class='btn icon icon-shape bg-success text-white rounded-circle shadow' style='margin: 0 0 10px 0;' ><i class='ni ni-check-bold text-white' style='font-size: 2rem;'></i></button><br><h2>"+msg+"</h2></div>");

// Show failed icon on pop up
showFailed = (msg = "Failed") => changePopUpCtn("<div style='text-align: center; margin: 24px;'><button type='button' class='btn icon icon-shape bg-danger text-white rounded-circle shadow' style='margin: 0 0 10px 0;' ><i class='ni ni-fat-remove text-white' style='font-size: 2rem;'></i></button><br><h2>"+msg+"</h2></div>");