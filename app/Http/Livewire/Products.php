<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Product;

class Products extends Component
{
    // $products,
    public $product_id, $name, $price, $category_id, $description, $image, $search;
    public $isModalOpen = 0;
    public $limitPerPage = 10;
    protected $queryString = ['search'=> ['except' => '']];
    protected $listeners = [
        'products' => 'postData'
    ];

    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $product = Product::latest()->paginate($this->limitPerPage);
        // dd($product);

        if($this->search != null){
            $product = Product::where('name', 'LIKE', '%'.$this->search.'%')->paginate($this->limitPerPage);
        }
        // dd($product);

        $this->emit('postStore');
        
        // $this->products = Product::all();
        // , 
        return view('livewire.products',['products' => $product]);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {
        $this->title = '';
        $this->desc = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'description' => $this->description,
        ]);

        session()->flash('message', $this->product_id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->description = $product->description;
    
        $this->openModal();
    }
    
    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}
