<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Inventory;
use App\Models\ItemEquipped;
use App\Models\UserLife;
use App\Models\UserArmour;
use App\Models\Attack;
use App\Models\UserAttack;
use App\Models\TypeAttack;


class CombatController extends BaseController
{
    public function attackAction(Request $request){
        $player1 = $request->player_1;
        $player2 = $request->player_2;

        // check last attack to ulti

        if($request->type_attack == 'u'){

            $lastAttack = Attack::where('user_attack_id', $player1)->where('user_affected_id', $player2)->orderBy('id', 'desc')->get();
    
            if(count($lastAttack) == 0 || $lastAttack[0]->type_attack != 'cc'){
                return $this->sendResponse('You can´t use ulti attack', "Attack");
            }
            
        }


        // get life players
        
        $playersLife = UserLife::select("*")->whereIn('user_id', [$player1, $player2])->get();

        foreach ($playersLife as $key => $pl) {
            if($pl->user_id == $player1){
                $player1Life = $pl->life_points;
            }else{
                $player2Life = $pl->life_points;
            }
        }

        // get item players

        $playersItems = ItemEquipped::select("*")->whereIn('user_id', [$player1, $player2])->get();

        $items = [];

        foreach ($playersItems as $key => $pi) {
            $items[] = $pi->item_id;
        }

        $items = array_values(array_unique($items));

        $items = Item::select("*")->whereIn('id', $items)->get();

        $player1Items = [];
        $player2Items = [];

        foreach ($playersItems as $key => $pi) {
            if($pi->user_id == $player1){
                foreach ($items as $key => $it) {
                    if($it->id == $pi->item_id){
                        $player1Items[] = $it;
                    }
                }
                
            }else{
                foreach ($items as $key => $it) {
                    if($it->id == $pi->item_id){
                        $player2Items[] = $it;
                    }
                }
            }
        }

        // get attack players

        $player1Attack = 5;

        foreach ($player1Items as $key => $p1i) {
            if($p1i->item_type == 'arma'){
                $player1Attack += $p1i->attack_points;
            }
        }


        // get armour players

        $player2Armour = 5;

        foreach ($player2Items as $key => $p2i) {
            if($p2i->item_type == 'armadura' || $p2i->item_type == 'bota'){
                $player2Armour += $p2i->armour_points;
            }
        }


        // get Type Attack

        $typeAttack = TypeAttack::where('name', $request->type_attack)->first();

        // action attack

        $damage = ($player1Attack * $typeAttack->power) - $player2Armour;

        if($damage < 0){
            $damage = 1;
        }

        $totalLife = $player2Life - $damage;

        $player2Life = ($totalLife < 0) ? 0 : $totalLife;

        // update life player 2

        $player2updated = UserLife::where('user_id', $player2)->first();

        $player2updated->life_points = $player2Life;

        $player2updated->save();

        // save attack

        $attack = new Attack();

        $attack->user_attack_id = $player1;
        $attack->user_affected_id = $player2;
        $attack->type_attack = $request->type_attack;
        $attack->save();


        return $this->sendResponse([$player1Attack, $player2Armour], "Attack");

        
    }
}
?>