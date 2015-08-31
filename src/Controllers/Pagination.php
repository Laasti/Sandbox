<?php

namespace Laasti\Sandbox\Controllers;

use Laasti\Response\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;

class Pagination
{
    use \League\Container\ContainerAwareTrait;
    use \Laasti\Pagination\PaginationFactoryTrait;

    protected $responder;

    protected $tasks = [
        ['id' => 10, 'name' => 'some task'],
        ['id' => 1, 'name' => 'some task1'],
        ['id' => 2, 'name' => 'some task2'],
        ['id' => 3, 'name' => 'some task3'],
        ['id' => 4, 'name' => 'some task4'],
        ['id' => 5, 'name' => 'some task5'],
        ['id' => 6, 'name' => 'some task6'],
        ['id' => 7, 'name' => 'some task7'],
        ['id' => 8, 'name' => 'some task8'],
    ];

    public function __construct(ResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function paginate(Request $request)
    {
        $pagination = $this->createPagination((int) $request->attributes->get('page', 1), count($this->tasks), 5);
        $pagination->setBaseUrl($request->getBaseUrl().'/pagination/');
        $this->responder->setData('pagination', $pagination);
        $this->responder->setData('tasks', array_slice($this->tasks, $pagination->getOffset(), $pagination->getLimit()));

        return $this->responder->view('paginated-tasks');
    }

}
