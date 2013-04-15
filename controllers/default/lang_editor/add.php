<?php
Reg::get('smarty')->assign('types', Constant::getAvailableTypes());
Reg::get('smarty')->assign('languages', Language::getAllLanguages());
