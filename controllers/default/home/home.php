<?php
Reg::get('smarty')->setLayout('home', true);
Reg::get('smarty')->addPrimaryJs("https://maps.googleapis.com/maps/api/js?sensor=true");
Reg::get('smarty')->addJs("map.js");
