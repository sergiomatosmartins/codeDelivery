<?php
namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\ProductRepository;


class ProductsController extends Controller
{

    private $repository;
    private $categoryRepository;

    public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository)
    {

        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {

        $products = $this->repository->paginate(10);

        return view('admin.products.index', compact('products'));


    }

    public function create()
    {

        $categories = $this->categoryRepository->lists('name', 'id');
        return view('admin.products.create', compact('categories'));

    }

    public function store(AdminCategoryRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('admin.products.index');
    }


    public function edit($id)
    {
        $product = $this->repository->find($id);
        $categories = $this->categoryRepository->lists('name', 'id');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(AdminCategoryRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.products.index');

    }


    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.products.index');

    }
};