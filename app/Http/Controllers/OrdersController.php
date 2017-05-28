<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 24/05/2017
 * Time: 22:32
 */

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Repositories\OrderRepository;

class OrdersController extends Controller
{

    public function __construct(OrderRepository $repository)
    {
         $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->paginate();

        return view('admin.orders.index', compact('orders'));
    }


}