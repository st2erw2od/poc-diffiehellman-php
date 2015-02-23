/* 
 * generate a 100-digit long random number
 * please note there isn't enough entropy for productive use!
 */
function generateRandomNumber(){
	var nr = "";
	for(i=0; i<25; i++) {
		nr += Math.floor(Math.random()*(9999-1000+1))+1000;
	}
	return nr;
}