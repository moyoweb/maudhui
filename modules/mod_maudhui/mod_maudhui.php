<?php

echo KService::get('mod://site/maudhui.html')
    ->module($module)
    ->attribs($attribs)
    ->display();