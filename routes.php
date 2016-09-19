<?php 
$ROUTES = [
	
		//Home page routes
		['^\/?$',"Index"],
		["^home\/?$","Index"],
		
		//Login routes
		["^account\/login\/?$","account/Login"],
		["^account\/signin\/?$","account/Signup"],
		["^account\/signup\/?$","account/Signup"],

		//For debug purposes only and will e removed in production
		["^debug\/?$","debug"],
];