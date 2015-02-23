$(document).ready(function(){	
	/*
	 * Diffie-Hellman key exchange
	 * client: a, g, p                 server: b
	 * A = g ^ a mod p   -> g, p, A    B = g ^ b mod p
	 * K = B ^ a mod p	       B <-    K = A ^ b mod p
	 * 
	 * p and g can be hardcoded, because these are just seeds
	 * the real magic happens with modulo (discrete logarithm problem)
	 */
	
	var p = str2bigInt('161521746670640296426473658228859984306663144318152681524054709078245736590366297248377298082656939330673286493230336261991466938596691073112968626710792148904239628873374506302653492009810626437582587089465395941375496004739918498276676334238241465498030036586063929902368192004233172032080188726965600617167',10,80);
	var g = str2bigInt('2',10,80);
	var secret = str2bigInt(generateRandomNumber(),10,80);
	var A = powMod(g,secret,p);
	var A_str = bigInt2str(A,10);
	exchangeKey();
	
	/*
	 * send calculated A to the server
	 * get B back from the server
	 */
	function exchangeKey(){
		$.ajax({
			type: 'GET',
			url: 'server.php?a='+A_str,
			dataType: 'json',
			contentType: 'application/json',
			success: function(json){
				$('#server_info').html('');
				$('#client_info').html('');
				$('#server_A').html(json.A); //unnecessary, debug-only
				$('#server_B').html(json.B);
				$('#server_K').html(json.K); //DEBUG-ONLY!!
				calculateKey(json.B);
			},
			error: function(jqXHR, textStatus, ex) {
				$('#server_info').html('Error: ' + textStatus + ', ' + ex + ', ' + jqXHR.responseText);
				$('#client_info').html('');
			}  
		});
	}
	
	/*
	 * calculate K with the received B
	 */
	function calculateKey(B_str){
		if(B_str !== undefined && B_str != ""){
			var B = str2bigInt(B_str,10,80);
			var K = powMod(B,secret,p);
			var K_str = bigInt2str(K,10);
			$('#client_A').html(A_str);
			$('#client_B').html(B_str);
			$('#client_K').html(K_str);
			testKeys();
		}
	}
	
	/*
	 * test both keys 
	 * (if it was returned from the server for debugging purposes)
	 */
	function testKeys(){
		var server_K = $.trim($('#server_K').text()); //DEBUG-ONLY!!
		var client_K = $.trim($('#client_K').text());
		if(server_K != "" && client_K != ""){
			if(server_K == client_K){
				$('#result_test').html("Keys are identical. Key exchange was successful.");
			}
			else {
				$('#result_test').html("Keys don't match! Key exchange failed.");
			}
		}
	}
});