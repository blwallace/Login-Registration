<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>
<body>
<script>
	$(document).ready(function(){


		var cars = ['A4', 'A8', 'Q5', 'RS7', 'S5', 'Continental', 'Bluecar', '228i', '320i', '328d', '328i', '335i', '340i', '428i', '435i', '528i', '535d', '535i', '550i', '640i', '650i', '740i', '750i', 'M235i', 'M3', 'M4', 'M5', 'M6', 'X1', 'X3', 'X4', 'X5', 'X6', 'Z4', 'John', 'Mini', 'MINI', 'Mini', 'MINI', 'Fiat', 'CRX', '488', 'California', 'F12', 'FF', 'C-Max', 'Escape', 'ESCAPE', 'Expedition', 'Explorer', 'Explorer Police FFV, AWD', 'Explorer Police FFV, FWD', 'F-150', 'F150', 'FIESTA', 'Fiesta', 'FLEX', 'FOCUS', 'Focus', 'FOCUS', 'Fusion', 'MKZ', 'Mustang', 'Police', 'T150', 'T250', 'Transit', 'TRANSIT', 'MKC', 'MKX', 'MKZ', 'Navigator', 'ENCLAVE', 'LACROSSE', 'REGAL', 'VERANO', 'ATS', 'ATS-V', 'CTS', 'CTS-V', 'ELR', 'ESCALADE', 'SRX', 'XTS', '1LH26', '1LK26', 'C15', 'C1500', 'CAMARO', 'CAPRICE', 'COLORADO', 'CORVETTE', 'CRUZE', 'EQUINOX', 'IMPALA', 'K15', 'K1500', 'MALIBU', 'SONIC', 'SPARK', 'TRAX', 'VOLT', 'CANYON', 'K1500', 'ILX', 'MDX', 'RDX', 'RLX', 'TLX', 'Accord', 'Civic', 'CR-V', 'Fit', 'HR-V', 'ODYSSEY', 'Pilot', 'RLX', 'Azera', 'Elantra', 'Equus', 'Genesis', 'Santa', 'Sonata', 'SONATA', 'Tucson', 'Optima', 'OPTIMA', 'L', 'Accent', 'Elantra', 'Veloster', 'Cadenza', 'Forte', 'Forte5', 'K900', 'Rio', 'Sedona', 'Sorento', 'Soul', 'Sportage', 'AVENTADOR', 'Ghibli', 'GHIBLI', 'GRANTURISMO', 'QUATTROPORTE', 'CX-3', 'CX-5', 'MAZDA2', 'MAZDA3', 'MAZDA6', 'MX-5', 'MLN', 'AMG', 'B-class', 'C', 'CLA', 'CLS', 'E', 'G', 'GL', 'GLA', 'GLE', 'Maybach', 'Metris', 'ML', 'S', 'SL', 'SLK', 'Smart', 'smart', 'MTX', 'INFINITI', 'NISSAN', 'PGN', '911', 'Boxster', 'Cayenne', 'Cayman', 'Macan', 'Panamera', 'QTM', 'Royce', 'Stage', 'BRZ', 'FORESTER', 'IMPREZA', 'LEGACY', 'OUTBACK', 'WRX', 'XV', 'Model', 'CT', 'ES', 'GX', 'IS', 'LS', 'LX', 'NX', 'iM', 'tC', '4RUNNER', 'CAMRY', 'Camry', 'COROLLA', 'LAND', 'MIRAI', 'PRIUS', 'RAV4', 'SEQUOIA', 'TACOMA', 'TUNDRA', 'YARIS', 'Beetle', 'CC', 'Eos', 'Jetta', 'Passat', 'PASSAT', 'Passat', 'Tiguan', 'Touareg', 'VGA', 'S60', 'V60', 'XC60', 'XC70', 'XC90'];
		
		// for(i = 0; i < cars.length; i++){

		// 	$.post( "http://localhost:8888/users/answer", { email: 'obama@uchicago.edu', answer: cars[i]})
		// 		  .done(function( data ) {
				  	
		// 		  	console.log("<br> Car Tested: " + cars[i] + ",Try Number: " + i +	 "Data Loaded: " + data );
		// 		});
		// }

		i = 0;
		function carCheck(ticker){
			$.post( "/users/answer", { email: 'obama@uchicago.edu', answer: cars[ticker]})
				  .done(function( data ) {
				  	console.log("<br> Car Tested: " + cars[ticker] + ",Try Number: " + ticker +	 "Data Loaded: " + data );
				  	$('body').append("<br> Car Tested: " + cars[ticker] + ",   Try Number: " + ticker +	 "    Data Loaded: " + data );
				  	if(ticker < cars.length - 1){
				  		ticker++;
				  		carCheck(ticker)
				  	}
				});
		}
		carCheck(i);

	});	


</script>




</body>
</html>