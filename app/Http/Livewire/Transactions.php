<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TransactionMaster;
use App\Models\TransactionDetail;

class Transactions extends Component
{
    public $id,$search;
    public $isModaltransactionOpen = 0;
    public $limitPerPage = 10;
    protected $queryString = ['search'=> ['except' => '']];
    protected $listeners = [
        'transactions' => 'postData'
    ];

    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function openModalTransaction()
    {
        $this->isModaltransactionOpen = true;
    }

    public function closeModalTransaction()
    {
        $this->isModaltransactionOpen = false;
    }

    public function render()
    {
        $transaction = TransactionMaster::latest()->paginate($this->limitPerPage);
        if($this->search !== null){
            // $transaction = TransactionMaster::where('name', 'LIKE', '%'.$this->search.'%')->paginate($this->limitPerPage);
            $transaction = TransactionMaster::with('user')->whereHas('user', function($query) {
                $query->where('name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('status', 'LIKE', '%'.$this->search.'%')
                ->orWhere('grand_total', 'LIKE', '%'.$this->search.'%');
            })->paginate($this->limitPerPage);
        }
        $this->emit('postData');
        return view('livewire.transactions', ['transactions' => $transaction]);
    }

    public function detailTransaction($id)
    {
        $transaction = TransactionDetail::with('transactionItems')->where('id', $id);
        $this->openModalTransaction();
    }
}
