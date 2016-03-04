function totalCost(id) {
	var cost = document.getElementById( id );
	var totalAmount = 0;
	totalAmount = parseFloat(cost.width2m.value) * parseFloat(cost.length2m.value);
	if (cost.servicetype[0].checked == true){
		totalAmount *= parseFloat(cost.servicetype[0].title); }
	else if (cost.servicetype[1].checked == true){
		totalAmount *= parseFloat(cost.servicetype[1].title); }
	else { totalAmount += 0;}
	cost.total.value = parseFloat(totalAmount); }