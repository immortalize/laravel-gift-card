<?php

namespace App\Http\Controllers;

use App\User;
use App\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $received = PointTransaction::where('receiver', $user_id)->whereNotNull('confirmation_timestamp')->sum('amount');
        $send = PointTransaction::where('sender', $user_id)->sum('amount');
	$points = $received - $send;

        return view('balance', [
		'balance' => $points
	]);
    }

    public function send()
    {
        $user_id = Auth::id();
//      $points = PointTransaction::where('receiver', $user_id)->sum('amount');
        $users = User::where('id','<>', $user_id)->get();

        return view('user_list', [
		'users' => $users
	]);
    }


    public function store(Request $request)
    {
        $user_id = Auth::id();
        $users = User::where('id','<>', $user_id)->get();
	$tx = new PointTransaction;
	$tx->sender = $user_id;
	$tx->receiver = $request->receiver;
	$tx->amount = $request->amount;
	$tx->tx_starter = 0;
	$tx->save();

	return redirect('/points');
    }

    public function requests()
    {
        $user_id = Auth::id();

        $send_requests = PointTransaction::whereRaw('tx_starter != ? and confirmation_timestamp is null and sender = ?', [$user_id, $user_id])
		->leftJoin('users', 'point_transactions.receiver', '=', 'users.id')
		->select('point_transactions.id as tx_id', 'point_transactions.created_at as tx_at', 'point_transactions.amount', 'users.name')
		->get();

        $receive_requests = PointTransaction::whereRaw('tx_starter != ? and confirmation_timestamp is null and receiver = ?', [$user_id, $user_id])
		->leftJoin('users', 'point_transactions.sender', '=', 'users.id')
		->select('point_transactions.id as tx_id', 'point_transactions.created_at as tx_at', 'point_transactions.amount', 'users.name')
		->get();

        return view('requests', [
		'send_requests' => $send_requests,
		'receive_requests' => $receive_requests
	]);
    }

   public function accept(Request $request)
    {
        $tx = new PointTransaction;
	$tx->where('id',$request->tx_id)->update(['confirmation_timestamp' => DB::raw('CURRENT_TIMESTAMP')]);

        return redirect('/points');
    }

}
