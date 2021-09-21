<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Item;

class ProductController extends Controller
{
    public function list() {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $products = Product::all()->sortByDesc("updated_at");
        $categories = Category::all();

        $data = [
            'user'=>$user,
            'products'=>$products,
            'categories'=>$categories
        ];

        return view('user/products', $data);
    }

    public function post(Request $req){
        $rules = [
            'image_url' => 'required|url',
            'name' => 'required|min:3|max:35',
            'category_id' => 'required',
            'description' => 'required|min:10|max:700',
            'price' => 'required'
        ];
    
        $customMessages = [
            'image_url.required' => 'O campo imagem do produto não foi preenchido.',
            'name.required' => 'O campo nome não foi preenchido.',
            'name.min' => 'É necessário no mínimo 3 caracteres no título.',
            'name.max' => 'É necessário no máximo 35 caracteres no título.',
            'category_id.required' => 'O campo categoria não foi preenchido.',
            'description.required' => 'O campo descrição não foi preenchido.',
            'price.required' => 'O campo valor não foi preenchido.',
            'image_url.url' => 'URL da imagem do produto é inválida',
            'description.min' => 'É necessário no mínimo 10 caracteres na descrição.',
            'description.max' => 'É necessário no máximo 700 caracteres na descrição.'
        ];

        $this->validate($req, $rules, $customMessages);


        $price = (filter_var($req->price, FILTER_SANITIZE_NUMBER_FLOAT)/100); 
        $price = number_format($price,2, '.', '');

        $query = DB::table('products')->insert([
            'image_url'=>$req->image_url,
            'name'=>$req->name,
            'description'=>$req->description,
            'price'=>$price,
            'category_id'=>$req->category_id,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        if(!$query) {
            return back()->withInput()->with('fail','Algo deu errado!');  
        }

        return redirect('/products')->with('success','Produto criado com sucesso!');
    }

    public function createProduct() {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $categories = Category::all();

        $data = [
            'user'=>$user,
            'categories'=>$categories
        ];

        return view('user/admin/createProduct', $data);
    }

    public function show($id) {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $product = Product::where('id', $id)->first();
        $category = Category::where('id', $product->category_id)->first();

        $data = [
            'user'=>$user,
            'product'=>$product,
            'category'=>$category
        ];

        return view('user/showProduct', $data);
    }

    public function edit($id) {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $product = Product::where('id', $id)->first();
        $categories = Category::all();

        $data = [
            'user'=>$user,
            'product'=>$product,
            'categories'=>$categories
        ];
        
        return view('user/admin/editProduct', $data);
    }

    public function put(Request $req, $id) {
        $rules = [
            'image_url' => 'required|url',
            'name' => 'required|min:3|max:35',
            'category_id' => 'required',
            'description' => 'required|min:10|max:700',
            'price' => 'required'
        ];
    
        $customMessages = [
            'image_url.required' => 'O campo imagem do produto não foi preenchido.',
            'name.required' => 'O campo nome não foi preenchido.',
            'name.min' => 'É necessário no mínimo 3 caracteres no título.',
            'name.max' => 'É necessário no máximo 35 caracteres no título.',
            'category_id.required' => 'O campo categoria não foi preenchido.',
            'description.required' => 'O campo descrição não foi preenchido.',
            'price.required' => 'O campo valor não foi preenchido.',
            'image_url.url' => 'URL da imagem do produto é inválida',
            'description.min' => 'É necessário no mínimo 10 caracteres na descrição.',
            'description.max' => 'É necessário no máximo 700 caracteres na descrição.'
        ];

        $this->validate($req, $rules, $customMessages);

        $product = Product::where('id', $id)->first();
        $price = (filter_var($req->price, FILTER_SANITIZE_NUMBER_FLOAT)/100); 
        $price = number_format($price,2, '.', '');

        if($product->category_id != $req->category_id) {
            return back()->withInput()->with('fail','Este produto está vinculado e não pode ter sua categoria alterada.'); 
        }

        $query = DB::table('products')->where('id', $id)->update([
            'image_url'=>$req->image_url,
            'name'=>$req->name,
            'description'=>$req->description,
            'price'=>$price,
            'category_id'=>$req->category_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if(!$query) {
            return back()->withInput()->with('fail','Algo deu errado!');  
        }

        return redirect('/products')->with('success','Produto editado com sucesso!');
    }

    public function delete($id) {

        $anyItem = Item::where('product_id','=', $id)->first();

        if($anyItem) {
            return back()->withInput()->with('fail','Este produto está vinculado e não pode ser excluído.');  
        }

        $product = Product::find($id);
        $product->delete();

        return redirect('/products')->with('success','Produto deletado com sucesso!');
    }
}