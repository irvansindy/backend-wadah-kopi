<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\File;

class Products extends Component
{

    use WithFileUploads;

    public $product_id, $name, $price, $category_id, $description, $images, $search;
    public $isModalOpen = 0;
    public $isModalImageOpen = 0;
    public $limitPerPage = 10;
    protected $queryString = ['search'=> ['except' => '']];
    protected $listeners = [
        'products' => 'postData'
    ];
    // public $images = [];

    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $product = Product::latest()->paginate($this->limitPerPage);

        if($this->search !== null){
            $product = Product::where('name', 'LIKE', '%'.$this->search.'%')->paginate($this->limitPerPage);
        }

        $this->emit('postData');
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
    
    public function openModalImage()
    {
        $this->isModalImageOpen = true;
    }

    public function closeModal()
    {   
        $this->isModalOpen = false;
        $this->isModalImageOpen = false;
    }

    private function resetCreateForm()
    {
        $this->name = '';
        $this->price = '';
        $this->category_id = '';
        $this->description = '';
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

    public function modalImage($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->openModalImage();
    }

    public function uploadProductImage()
    {        
        $dataValid = $this->validate([
            'images' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);
  
        $nameImage = md5($this->images . microtime()).'.'.$this->images->extension();

        $dataValid['images'] = $this->images->store('images', 'public');

        Product::findOrFail($this->product_id)->update([  
            // 'image' => $dataValid,
            'image' => $nameImage,
        ]);

        session()->flash('message', 'The photo is successfully uploaded!');

        $this->closeModal();
    }
}
