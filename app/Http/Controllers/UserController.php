<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Inventory;
use App\Models\ItemEquipped;
use App\Models\UserLife;
use App\Models\Attack;
use Illuminate\Support\Facades\DB;


class UserController extends BaseController
{

    public function getUser(Request $request)
    {

        $userId = ($request->id) ? $request->id : null;

        try {
                
            if($userId){

                $response = User::find($userId);
                
            }else{

                $response = User::all();

            }


            return $this->sendResponse($response, 'User information');

        }catch (\Throwable $th) {

            throw $th;

        }
    }


    // USERS INVENTORY

    public function getItems()
    {
            
            $userLogged = auth()->user();

            $userId = $userLogged->id;

            try {
                $userInventory = Inventory::where('user_id', $userId)->get();
    
                $items = [];
        
                foreach($userInventory as $item){
                    $items[] = Item::find($item->item_id);
                }
        
                return $this->sendResponse($items, "Items from inventory");
            } catch (\Throwable $th) {
                return $this->sendError( $th, [], 401);
            }
    

    }

    public function addItemToInventory (Request $request)
    {

        $userLogged = auth()->user();

        $userId = $userLogged->id;

        $item = Item::find($request->item_id);

        if(!$item){
            return $this->sendError("Item not exists", [], 401);
        }
  
        try {

            $newItem = Inventory::create([

                'user_id'=>$userId,
                'item_id'=>$item->id

            ]);

            return $this->sendResponse($newItem, "Item added to inventory");
        
        }catch (\Throwable $th) {

            return $this->sendError( $th, [], 401);

        }
    }

    public function deleteItemToInventory (Request $request) 
    {

        $userLogged = auth()->user();

        $userId = $userLogged->id;
  
        try {

            $userInventory = Inventory::where('user_id', $userId)->where('item_id', $request->item_id)->first();
            $response = $userInventory->delete(); 

            return $this->sendResponse($response, "Item deleted from inventory");
        
        }catch (\Throwable $th) {

            return $this->sendError( $th, [], 401);

        }
    }



    // USERS EQUIPPED ITEMS

    public function getEquippedItems(Request $request)
    {
        $userLogged = auth()->user();

        $userId = $userLogged->id;

        try {
            $userInventory = ItemEquipped::where('user_id', $userId)->get();

            $items = [];
    
            foreach($userInventory as $item){
                $items[] = Item::find($item->item_id);
            }
    
            return $this->sendResponse($items, "Items from inventory");
        } catch (\Throwable $th) {
            return $this->sendError( $th, [], 401);
        }
    }

    public function addItemEquipped (Request $request)
    {

        $userLogged = auth()->user();

        $userId = $userLogged->id;

        $item = Inventory::where('user_id', $userId)->where('item_id', $request->item_id)->first();

        
        if(!$item){
            return $this->sendError("Item not exists in inventory", [], 401);
        }

        $itemFound = Item::find($item->item_id);

        try {

            $newItem = ItemEquipped::where('user_id', $userId)->where('type_item', $itemFound->item_type)->first();

            if($newItem){
                return $this->sendResponse(false, "Type Item already exists in inventory");
            }

            $newItemEquipped = ItemEquipped::create([

                'user_id'=>$userId,
                'item_id'=>$itemFound->id, 
                'type_item'=>$itemFound->item_type,

            ]);

            return $this->sendResponse($newItemEquipped, "Item added to inventory");
        
        }catch (\Throwable $th) {

            return $this->sendError( $th, [], 401);

        }
    }

    public function deleteItemEquipped (Request $request)
    {
       
        $userLogged = auth()->user();

        $userId = $userLogged->id;
  
        try {

            $userInventory = ItemEquipped::where('user_id', $userId)->where('item_id', $request->item_id)->first();
            $response = $userInventory->delete(); 

            return $this->sendResponse($response, "Item deleted from equipped items");
        
        }catch (\Throwable $th) {

            return $this->sendError( $th, [], 401);

        }
    }


    // ADMIN FUNCTIONS

    public function createUserAdmin(Request $request) 
    {

        $userLogged = auth()->user();

        if($userLogged->user_type != 'a'){
            return $this->sendError("Unauthorized", [], 401);
        }
        
        $user = $request;
        
        if(!empty($user->name) && !empty($user->email) && !empty($user->password) && !empty($user->user_type)) {
            
            $newUser = User::create([

                'name' => $user->name,
                'email' => $user->email,
                'player_type' => $user->player_type,
                'user_type' => $user->user_type,
                'password' => bcrypt($user->password)

            ]);

            if($user->user_type == "p") {
                $newUserLife = UserLife::create([
                    'user_id' => $newUser->id, 
                    'life_points' => 100
                ]);
            }
            
            return $this->sendResponse([$newUser, $newUserLife], "User added");
        }

        return $this->sendError("Missing parameters", [], 401);
    
    }

    public function createItemAdmin(Request $request) 
    {

        $userLogged = auth()->user();

        if($userLogged->user_type != 'a'){
            return $this->sendError("Unauthorized", [], 401);
        }
  
        $item = $request;
  
        try {

            $newUser = Item::create([

                'name' => $item->name,
                'item_type' => $item->item_type,
                'armour_points' => $item->armour_points,
                'attack_points' => $item->attack_points,

            ]);

            $response = $newUser;

            return $this->sendResponse($response, "Item Create");
        
        }catch (\Throwable $th) {

            throw $th;

        }

    }

    public function updateItemAdmin (Request $request)
    {

        $userLogged = auth()->user();

        if($userLogged->user_type != 'a'){
            return $this->sendError("Unauthorized", [], 401);
        }

        try {

            $item = Item::find($request->item_id);

            $form = [
                'name'=>$item->name,
                'item_type'=>$item->item_type,
                'armour_points'=>$item->armour_points,
                'attack_points'=>$item->attack_points
            ];

            $itemUpdated = $item->update($form);

            return $this->sendResponse($itemUpdated, 'The Item have been successfully updated.');

        
        }catch (\Throwable $th) {

            throw $th;

        }

    }

    public function showUlti()
    {
        $ultiReady = $results = DB::select('select a.* from attacks a
        inner join 
        (
        select user_attack_id, user_affected_id, max(created_at) created_at from attacks group by user_attack_id, user_affected_id
        )b
        on a.user_attack_id = b.user_attack_id and a.user_affected_id = b.user_affected_id and a.created_at = b.created_at
        where a.type_attack = ?', ['cc']);

        return $ultiReady;
    }

    // public function getItem(Request $request)
    // {
    //     $itemId = $request->id;
    //     try {
                
    //         $item = Item::find($itemId);
    //         return $this->sendResponse($item, 'item information');

    //     }catch (\Throwable $th) {

    //         throw $th;

    //     }
    // }

    // public function deleteItem (Request $request)
    // {
    //     $itemId = $request->id;
    //     try {

    //         $item = Item::where("id", $itemId);
    //         $item->delete();
    //         return $this->sendResponse(true, 'Item Delete');

    //     } catch (\Throwable $th) {

    //         throw $th;

    //     }
    // }

}
