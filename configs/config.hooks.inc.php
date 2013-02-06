<?php
$CONFIG['Hooks'] = array(	'BeforePackagesLoad' => array(
									'setSitePath'
									),
		
		
							'BeforeController' => array(
									'smartyAssigns'
									),
		
							'NoDebugExceptionHandler' => array(
									'localNoDebugExceptionHandler', 
									'requestLimiterHandler'
									),
		
							'ExceptionHandler' => array(
									'localExceptionHandler'
									),
		
							'ErrorHandler' => array(
									'localExceptionHandler'
									)
						);
