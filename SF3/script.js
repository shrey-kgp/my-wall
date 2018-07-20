$(document).ready(() => {
var a1=0,a2=0,b1=0,b2=0;  
var turn=1;
var locker_A=2,locker_B=2;
var dice;


var boxes = $('.grid-container').text();
var arr = jQuery.makeArray( boxes );

$('#play').click(function(){ roll();});

function roll(){
	
	dice=result_generate();
	document.getElementById('dicestatus').innerHTML= dice;
	if (turn===1 && locker_A===2)
	{
		if (dice===6)
		{
			release_a1();
			//the user should be able to click on a1
			locker_A--;
			document.getElementById('lockerA').innerHTML='1A';
			document.getElementById('b'+'-'+1).innerHTML='A1';
			//A should be printed on b-1
			
		}
	    else {
		turn=0;
		document.getElementById('turn_player').innerHTML='B';
		}
		
	}

	else if (turn===1 && locker_A===1)
	    {
  		   if (dice===6)
		   {   
	          var hasbeenClicked=false;
	          $('#lockerA').click(function(){
              hasbeenClicked=true;
			  if(hasbeenClicked) {
               //clicked element, do-some-stuff
			       release_a2();
				   locker_A--;
				   document.getElementById('lockerA').innerHTML='0A';
				   document.getElementById('b'+'-'+1).innerHTML='A2';
				   //A should be printed on b-1
				   $('#play').click(function(){ roll();});
              }} );
			 if(hasbeenClicked==false) {
              //run function2
			       check();
				   move_a1();
				   trespassA();
				   $('#play').click(function(){ roll();});
		          }
              	          
		   }
			  			   
		 if (dice!==6)
		 {
			 check();
			 move_a1();
			 trespassA();
			 turn = 0;
			 document.getElementById('turn_player').innerHTML='B';
		 }
		}
    else if(turn===1 && locker_A===0)
	{
		var hasbeenClicked=false;
	          $('#b-'+a1).click(function(){
              hasbeenClicked=true;
			  if(hasbeenClicked){
			                      check();
			                      move_a1();
			                      trespassA();
			                      if (dice===6) roll();
			else {
				document.getElementById('turn_player').innerHTML='B';
				turn =0;}
		}
              });
	          
		$('#b-'+a2).click(function(){
              hasbeenClicked=true;
			  if(hasbeenClicked){
			                      check();
			                      move_a2();
			                      trespassA();
			                      if (dice===6) $('#play').click(function(){ roll();});
			                      else {
				                        document.getElementById('turn_player').innerHTML='B';
				                        turn =0;}
		                        }
              });
	           
	}
	/////////////////////////////////////////////
	////////////////////////////////////////////
	///////////////////////////////////////////
	//B portion

    else if (turn===0 && locker_B===2)
	{
		if (dice===6)
		{
			release_b1();
			//the user should be able to click on b1
			locker_B--;
			document.getElementById('lockerB').innerHTML='1B';
			
			//B should be printed on b-15
			
		}
	    else 
		{
			turn=1;
	       document.getElementById('turn_player').innerHTML='A'; 
	    }
		
	}

	else if (turn===0 && locker_B===1)
	    {
  		   if (dice===6)
		   {
			   var hasbeenClicked=false;
	          $('#lockerB').click(function(){
              hasbeenClicked=true;
			  if(hasbeenClicked) {
               //clicked element, do-some-stuff
			       release_b2();
				   locker_B--;
				   document.getElementById('lockerB').innerHTML='0B';
				   document.getElementById('b'+'-'+((b2+14)%28)+1).innerHTML='B2';
				   //A should be printed on b-1
				   $('#play').click(function(){ roll();});
		      }}); 
			  if(hasbeenClicked==false) {
              //run function2
			       check();
				   move_b1();
				   trespassB();
				   $('#play').click(function(){ roll();});
		          }
              }	
		   			  
		 if (dice!==6)
		 {
			 check();
			 move_b1();
			 trespassB();
			 turn = 1;
			 document.getElementById('turn_player').innerHTML='A';
		 }
		}
    else if(turn===0 && locker_B===0)
	{
		var hasbeenClicked=false;
	          $('#b-'+((b1+14)%28)+1).click(function(){
              hasbeenClicked=true;
			  if(hasbeenClicked){
			                      check();
			                      move_b1();
			                      trespassB();
			                      if (dice===6) $('#play').click(function(){ roll();});
			else {
				document.getElementById('turn_player').innerHTML='A';
				turn =1;}
		}
              });
	          
		$('#b-'+((b2+14)%28)+1).click(function(){
              hasbeenClicked=true;
			  if(hasbeenClicked){
			                      check();
			                      move_b2();
			                      trespassB();
			                      if (dice===6) $('#play').click(function(){ roll();});
			                      else {
				                        document.getElementById('turn_player').innerHTML='A';
				                        turn =1;}
		                        }
              }); 
	}
}

	
function release_a1(){
	//print A in b-1
	a1++;
	document.getElementById('b'+'-'+a1).innerHTML='A1';
}	

function release_a2(){
	//print A in b-1
	a2++;
	document.getElementById('b'+'-'+a2).innerHTML='A2';
}	

function release_b1(){
	//print A in b-1
	b1++;
	document.getElementById('b'+'-'+((b1+14)%28)).innerHTML='B1';
	
}	

function release_b2(){
	//print A in b-1
	b2++;
	document.getElementById('b'+'-'+((b2+14)%28)).innerHTML='B2';
	
}

function move_a1(){
	if ((a1)+dice>27)
	{
		//no action
	}
	else if (a1+dice===28)
	{   document.getElementById('b'+'-'+a1).innerHTML='';
		a1='home';
		//print on the sidelines
	}
	else {
		document.getElementById('b'+'-'+a1).innerHTML='';
		a1+=dice;
		document.getElementById('b'+'-'+a1).innerHTML='A1';
		//print A in that box
	}
		
}

function move_a2(){
	if (a2+dice>27)
	{
		//no action
	}
	else if (a2+dice===28)
	{   document.getElementById('b'+'-'+a2).innerHTML='';
		a2='home';
		//print on the sidelines
	}
	else {
		document.getElementById('b'+'-'+(a2)).innerHTML='';
		a2+=dice;
		document.getElementById('b'+'-'+(a2)).innerHTML='A2';
		//print A in that box
	}
		
}

function move_b1(){
	if (b1+dice>27)
	{
		//no action
	}
	else if (b1+dice===28)
	{   document.getElementById('b'+'-'+((b2+14)%28)).innerHTML='';
		b1='home';
		//print on the sidelines
	}
	else {
		document.getElementById('b'+'-'+((b1+14)%28)).innerHTML='';
		b1+=dice;
		document.getElementById('b'+'-'+((b1+14)%28)).innerHTML='B1';
		//print A in that box
	}
		
}

function move_b2(){
	if (b2+dice>27)
	{
		//no action
	}
	else if (b2+dice===28)
	{   document.getElementById('b'+'-'+((b2+14)%28)).innerHTML='';
		b2='home';
		//print on the sidelines
	}
	else {
		document.getElementById('b'+'-'+((b2+14)%28)).innerHTML='';
		b2+=dice;
		document.getElementById('b'+'-'+((b2+14)%28)).innerHTML='B2';
		//print A in that box
	}
		
}

function check(){
	if ((a1==='home' && a2==='home') && (b1!=='home' || b2!=='home'))
	{
		//print A won the game
		document.getElementById('turn_player').innerHTML='A won the game';
	}
	if ((b1==='home' && b2==='home') && (a1!=='home' || a2!=='home'))
	{
		//print A won the game
		document.getElementById('turn_player').innerHTML='B won the game';
	}
}

function trespassA(){
	if (a1===((b1+14)%28))
	{
		//print A in that box
		document.getElementById('b'+'-'+a1).innerHTML='A1';
		b1=0;
		locker_B++;
		document.getElementById('lockerB').innerHTML=locker_A+'B';
		
	}
	if (a1===((b2+14)%28))
	{
		//print A in that box
		document.getElementById('b'+'-'+a1).innerHTML='A1';
		b2=0;
		locker_B++;
		document.getElementById('lockerB').innerHTML=locker_B+'B';
	}
    if (a2===((b1+14)%28))
	{
		//print A in that box
		document.getElementById('b'+'-'+a2).innerHTML='A2';
		b1=0;
		locker_B++;
		document.getElementById('lockerB').innerHTML=locker_B+'B';
	}
	if (a2===((b2+14)%28))
	{
		//print A in that box
		document.getElementById('b'+'-'+a2).innerHTML='A2';
		b2=0;
		locker_B++;
		document.getElementById('lockerB').innerHTML=locker_B+'B';
	}
}

function trespassB(){
	if (a1===((b1+14)%28))
	{
		//print A in that box
		document.getElementById('b'+'-'+a1).innerHTML='B1';
		a1=0;
		locker_A++;
		document.getElementById('lockerA').innerHTML=locker_A+'A';
	}
	if (a1===((b2+14)%28))
	{
		//print A in that box
		document.getElementById('b'+'-'+a1).innerHTML='B2';
		a1=0;
		locker_A++;
		document.getElementById('lockerA').innerHTML=locker_A+'A';
	}
    if (a2===((b1+14)%28))
	{
		//print A in that box
		document.getElementById('b'+'-'+a2).innerHTML='B1';
		a2=0;
		locker_A++;
		document.getElementById('lockerA').innerHTML=locker_A+'A';
	}
	if (a2===((b2+14)%28)+1)
	{
		//print A in that box
		document.getElementById('b'+'-'+a2).innerHTML='B2';
		a2=0;
		locker_A++;
		document.getElementById('lockerA').innerHTML=locker_A+'A';
	}
}

function result_generate(){
	return parseInt(Math.floor(Math.random()*6)+1);
}
});
