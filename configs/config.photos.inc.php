<?php
$CONFIG['Image']['ImageUploader']['AuxConfig'] = array(
											'uploadDir' => 'uploads/photos/data/',
											'minimumSize' => array('largeSideMinSize'=> 400, 'smallSideMinSize' => 150)
										);
										
$CONFIG['Users']['UserPhotos']['AuxConfig'] = array('maxPhotosCount' => 30);

$CONFIG['Image']['ImageModificator']['AuxConfig'] = array(	'imageModels' => array(
																'usersSmall' => array(
																	'actions' => array(
																		'crop' => array(
																			'ratio' => '1:1',
																			'smallSideMinSize' => 75,
																			'applyDefaultCrop' => true
																		),
																		'resize' => array(
																			'width' => 75,
																			'height' => 75
																		)
																	)
																),
																'usersMedium' => array(
																	'actions' => array(
																		'crop' => array(
																			'ratio' => '1:1',
																			'smallSideMinSize' => 150,
																			'applyDefaultCrop' => true
																		),
																		'resize' => array(
																			'width' => 150,
																			'height' => 150
																		)
																	)
																),
																'usersBig' => array(
																	'actions' => array(
																		'resize' => array(
																			'width' => 1000,
																			'height' => 1000
																		)
																	)
																)
															)
);

$CONFIG['Image']['ImageCache']['AuxConfig'] = array(
											'cacheDir' => 'uploads/photos/cache/',
											'folders' => array(
													'usersSmall',
													'usersMedium',
													'usersBig'
													)
										);

