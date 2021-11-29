<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    
    protected $product;
    public function __construct()
    {
        $this->product = new ProductModel();
        $this->pager = \Config\Services::pager();
        
    }
    public function product()
    {
        $session = session();
        // $data['product'] = $this->product->where('user_id', session()->get('user_id'))->findAll();
        $data = [
            'product' => $this->product->paginate('10','product'),
            'pager' => $this->product->pager
        ];
         $session->setFlashdata('inputmsg', 'ditambahkan');
        // dd($data);
        return view('user/product/v_product', $data);
    }
    public function add_product()
    {
        return view('user/product/v_add');
    }
    public function edit_product($product_id)
    {
        $data = $this->product->find($product_id);
        if($data['user_id'] != session()->get('user_id')){
            return redirect()->to('/product');
        }
        return view('user/product/v_edit', $data);
    }
    public function delete_product($product_id)
    {
        $data = $this->product->find($product_id);
        if($data['user_id'] == session()->get('user_id')){
            $this->product->delete($product_id);
        }
        session()->setFlashdata('inputmsg','Dihapus!');
        return redirect()->to('/product');
    }
    public function save_new()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name is required!'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description is required!'
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Category is required!'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Price is required!'
                ]
            ],
            'stock' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stock is required!'
                ]
            ],
           
 
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'user_id' => session()->get('user_id'),
            'category_id' => $this->request->getVar('category_id'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock')
        ];
        
        $this->product->save($data);
        session()->setFlashdata('inputmsg','Ditambahkan!');
        return redirect()->to('/product');
    }
    public function save_edit($product_id)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name is required!'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description is required!'
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Category is required!'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Price is required!'
                ]
            ],
            'stock' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stock is required!'
                ]
            ],
           
 
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $this->product->update($product_id, [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'user_id' => session()->get('user_id'),
            'category_id' => $this->request->getVar('category_id'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock')
        ]);
        session()->setFlashdata('inputmsg','Diubah!');
        return redirect()->to('/product');
    }
}