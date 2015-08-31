<?php

return [
    ['GET', '/', 'Laasti\Sandbox\Controllers\HelloWorld::welcome'],
    ['GET', '/template/{name:word}', 'Laasti\Sandbox\Controllers\Template::display'],
    ['GET', '/pagination', 'Laasti\Sandbox\Controllers\Pagination::paginate'],
    ['GET', '/pagination/{page:number}', 'Laasti\Sandbox\Controllers\Pagination::paginate'],
    ['GET', '/form', 'Laasti\Sandbox\Controllers\Form::display'],
    ['POST', '/form', 'Laasti\Sandbox\Controllers\Form::submit'],
];