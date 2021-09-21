<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\PCBuild;
use App\Models\Item;

class PCBuildController extends Controller
{
    public function buildPC() {
        for($i = 1; $i <= 7; $i++) {
            $categories[] = Product::all()->where('category_id', $i);
        }

        $user = User::where('id','=',session('LoggedUser'))->first();

        $data = [
            'user'=>$user,
            'categories'=>$categories
        ];

        return view('user/createPCBuild', $data);
    }

    public function post(Request $req) {
        $rules = [
            'motherboard' => 'required',
            'cpu' => 'required',
            'gpu' => 'required',
            'ram' => 'required',
            'storage' => 'required',
            'powersuply' => 'required',
            'case' => 'required'
        ];
    
        $customMessages = [
            'motherboard.required' => 'Placa mãe não foi selecionada.',
            'cpu.required' => 'Processador não foi selecionado.',
            'gpu.required' => 'Placa de vídeo não foi selecionada.',
            'ram.required' => 'Memória RAM não foi selecionada.',
            'storage.required' => 'Armazenamento não foi selecionado.',
            'powersuply.required' => 'Fonte não foi selecionada.',
            'case.required' => 'Gabinete não foi selecionado.'
        ];

        $this->validate($req, $rules, $customMessages);

        $user = User::where('id','=',session('LoggedUser'))->first();

        $motherboard = Product::where('name','=',$req->motherboard)->first();
        $cpu = Product::where('name','=',$req->cpu)->first();
        $gpu = Product::where('name','=',$req->gpu)->first();
        $ram = Product::where('name','=',$req->ram)->first();
        $storage = Product::where('name','=',$req->storage)->first();
        $powersuply = Product::where('name','=',$req->powersuply)->first();
        $case = Product::where('name','=',$req->case)->first();

        $totalPrice = (filter_var($req->total_price, FILTER_SANITIZE_NUMBER_FLOAT)/100); 
        $totalPrice = number_format($totalPrice,2, '.', '');

        $pcbuildId = PCBuild::insertGetId([
            'total_price' => $totalPrice,
            'user_id' => $user->id,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        $pccomponents = array($motherboard, $cpu, $gpu, $ram, $storage, $powersuply, $case);

        foreach($pccomponents as $key => $pccomponent) {
            if($key == 3) {
                DB::table('items')->insert([
                    'pcbuild_id'=>$pcbuildId,
                    'product_id'=>$ram->id,
                    'quantity'=>$req->ramQty,
                    'stated_price'=>$pccomponent->price
                ]);
            } else if ($key == 4) {
                $query = DB::table('items')->insert([
                    'pcbuild_id'=>$pcbuildId,
                    'product_id'=>$storage->id,
                    'quantity'=>$req->storageQty,
                    'stated_price'=>$pccomponent->price
                ]);
            } else {
                DB::table('items')->insert([
                    'pcbuild_id'=>$pcbuildId,
                    'product_id'=>$pccomponent->id,
                    'stated_price'=>$pccomponent->price
                ]);
            }
        }

        if(!$query) {
            return back()->withInput()->with('fail','Algo deu errado!');  
        }

        return redirect('/pc-builds')->with('success','Computador montado com sucesso!'); 
    }

    public function list() {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $pcbuilds = PCBuild::all()->sortBy("created_at");

        foreach($pcbuilds as $pcbuild) {
            $items = Item::where('pcbuild_id','=', $pcbuild->id)->pluck('product_id')->toArray();
            $product = Product::where('id','=',$items[6])->first();
            $pcbuild->case_url = $product->image_url;

            $pcbuildUser = User::where('id','=',$pcbuild->user_id)->first();
            $pcbuild->user_name = $pcbuildUser->name;
        }

        $data = [
            'user'=>$user,
            'pcbuilds'=>$pcbuilds
        ];

        return view('user/home', $data);
    }

    public function userList() {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $pcbuilds = PCBuild::all()->where('user_id','=', $user->id)->sortBy("created_at");

        foreach($pcbuilds as $pcbuild) {
            $items = Item::where('pcbuild_id','=', $pcbuild->id)->pluck('product_id')->toArray();
            $product = Product::where('id','=',$items[6])->first();
            $pcbuild->case_url = $product->image_url;
        }

        $data = [
            'user'=>$user,
            'pcbuilds'=>$pcbuilds
        ];

        return view('user/pcBuilds', $data);
    }

    public function show($id) {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $pcbuild = PCBuild::where('id', $id)->first();

        $pcbuildUser = User::where('id','=',$pcbuild->user_id)->first();
        $pcbuild->user_name = $pcbuildUser->name;
        $itemList = Item::all()->where('pcbuild_id','=', $pcbuild->id)->sortBy('id');

        foreach($itemList as $item) {
            $items[] = $item;
        }

        for($i = 0; $i <= 6; $i++) {
            $pccomponents[$i] = Product::where('id','=', $items[$i]->product_id)->first();
            $item = Item::where('product_id','=', $items[$i]->product_id)->first();
            $pccomponents[$i]->price = $item->stated_price;
        }

        $pcbuild->case_url = Product::where('id','=', $items[4]->id)->get()->pluck('image_url');

        $pccomponents[3]->quantity = $items[3]->quantity;
        $pccomponents[4]->quantity = $items[4]->quantity;
        $pccomponents[3]->total_price = $pccomponents[3]->price * $pccomponents[3]->quantity;
        $pccomponents[4]->total_price = $pccomponents[4]->price * $pccomponents[4]->quantity;

        $data = [
            'user'=>$user,
            'pcbuild'=>$pcbuild,
            'pccomponents'=>$pccomponents
        ];

        return view('user/showPCBuild', $data);
    }

    public function edit($id) {
        $user = User::where('id','=',session('LoggedUser'))->first();
        $pcbuild = PCBuild::where('id', $id)->first();
        $itemList = Item::all()->where('pcbuild_id','=', $pcbuild->id)->sortBy('id');
        $accumulatedPrices = 0;

        for($i = 1; $i <= 7; $i++) {
            $categories[] = Product::all()->where('category_id', $i);
        }

        foreach($itemList as $item) {
            $items[] = $item;
        }

        for($i = 0; $i <= 6; $i++) {
            $pccomponents[$i] = Product::where('id','=', $items[$i]->product_id)->first();
            if($i < 3) {
                $accumulatedPrices += $pccomponents[$i]->price;
            } else if($i > 4) {
                $accumulatedPrices += $pccomponents[$i]->price;
            }
        }

        $pccomponents[3]->quantity = $items[3]->quantity;
        $pccomponents[3]->total_price = $pccomponents[3]->price * $items[3]->quantity;
        $pccomponents[4]->quantity = $items[4]->quantity;
        $pccomponents[4]->total_price = $pccomponents[4]->price * $items[4]->quantity;

        $accumulatedPrices += $pccomponents[3]->total_price;
        $accumulatedPrices += $pccomponents[4]->total_price;

        $pcbuild->total_price = $accumulatedPrices;

        $data = [
            'user'=>$user,
            'categories'=>$categories,
            'pcbuild'=>$pcbuild,
            'pccomponents'=>$pccomponents
        ];

        return view('user/editPCBuild', $data);
    }

    public function put(Request $req, $id) {
        $rules = [
            'motherboard' => 'required',
            'cpu' => 'required',
            'gpu' => 'required',
            'ram' => 'required',
            'storage' => 'required',
            'powersuply' => 'required',
            'case' => 'required'
        ];
    
        $customMessages = [
            'motherboard.required' => 'Placa mãe não foi selecionada.',
            'cpu.required' => 'Processador não foi selecionado.',
            'gpu.required' => 'Placa de vídeo não foi selecionada.',
            'ram.required' => 'Memória RAM não foi selecionada.',
            'storage.required' => 'Armazenamento não foi selecionado.',
            'powersuply.required' => 'Fonte não foi selecionada.',
            'case.required' => 'Gabinete não foi selecionado.'
        ];

        $this->validate($req, $rules, $customMessages);

        $user = User::where('id','=',session('LoggedUser'))->first();

        $motherboard = Product::where('name','=',$req->motherboard)->first();
        $cpu = Product::where('name','=',$req->cpu)->first();
        $gpu = Product::where('name','=',$req->gpu)->first();
        $ram = Product::where('name','=',$req->ram)->first();
        $storage = Product::where('name','=',$req->storage)->first();
        $powersuply = Product::where('name','=',$req->powersuply)->first();
        $case = Product::where('name','=',$req->case)->first();

        $totalPrice = (filter_var($req->total_price, FILTER_SANITIZE_NUMBER_FLOAT)/100); 
        $totalPrice = number_format($totalPrice,2, '.', '');

        $query = DB::table('pcbuilds')->where('id', $id)->update([
            'total_price' => $totalPrice,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if(!$query) {
            return back()->withInput()->with('fail','Algo deu errado!');  
        }

        $itemId = Item::all()->where('pcbuild_id','=', $id)->pluck('id');

        $pccomponents = array($motherboard, $cpu, $gpu, $ram, $storage, $powersuply, $case);

        for($i = 0; $i <= 6; $i++) {
            if($i == 3) {
                DB::table('items')->where('id', $itemId[$i])->update([
                    'product_id'=>$pccomponents[$i]->id,
                    'stated_price'=>$pccomponents[$i]->price,
                    'quantity'=>$req->ramQty
                ]);
            } else if($i == 4) {
                DB::table('items')->where('id', $itemId[$i])->update([
                    'product_id'=>$pccomponents[$i]->id,
                    'stated_price'=>$pccomponents[$i]->price,
                    'quantity'=>$req->storageQty
                ]);
            } else {
                DB::table('items')->where('id', $itemId[$i])->update([
                    'product_id'=>$pccomponents[$i]->id,
                    'stated_price'=>$pccomponents[$i]->price
                ]);
            }
        }

        return redirect('/pc-builds')->with('success','Computador editado com sucesso!'); 
    }

    public function delete($id) {

        $pcbuild = PCBuild::find($id);

        Item::where('pcbuild_id',$id)->delete();

        $pcbuild->delete();

        return redirect('/')->with('success','Computador deletado com sucesso!');
    }
}
