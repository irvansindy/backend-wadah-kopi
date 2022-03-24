<?php

namespace App\Http\Livewire;

use App\Models\TransactionMaster;
use Livewire\Component;

class Transactions extends Component
{
    public $search;
    public $limitPerPage = 10;
    protected $queryString = ['search'=> ['except' => '']];
    protected $listeners = [
        'transactions' => 'postData'
    ];

    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $transaction = TransactionMaster::latest()->paginate($this->limitPerPage);
        if($this->search !== null){
            // $transaction = TransactionMaster::where('name', 'LIKE', '%'.$this->search.'%')->paginate($this->limitPerPage);
            $transaction = TransactionMaster::with('user')->whereHas('user', function($query) {
                $query->where('name', 'LIKE', '%'.$this->search.'%');
            })->paginate($this->limitPerPage);
        }
        $this->emit('postData');
        return view('livewire.transactions', ['transactions' => $transaction]);
    }
}
