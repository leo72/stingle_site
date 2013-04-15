<?php
$CONFIG['Hooks'] = array(	'BeforePackagesLoad' => array(
									'setSitePath'
									),
		
		
							'BeforeController' => array(
									'smartyAssigns',
									'commonLayoutInit'
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
