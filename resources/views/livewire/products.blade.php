<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-slot name="header">
        {{-- <h2 class="text-center">Tutorial CRUD Laravel dengan Jetstream Livewire</h2> --}}
        <h2 class="text-center">List Data Product</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <button wire:click="create()" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 mb-4 rounded">Create Product</button>
                <input class="form-control mb-3 rounded" type="text" wire:model="search" placeholder="Search" aria-label="search">
                @if($isModalOpen)
                @include('livewire.createProduct')
                @endif
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($products); --}}
                        @foreach($products as $product)
                            <tr>
                                <td class="border px-4 py-2">{{ $product->id }}</td>
                                <td class="border px-4 py-2">{{ $product->name }}</td>
                                <td class="border px-4 py-2">{{ $product->price}}</td>
                                <td class="border px-4 py-2">{{ $product->description}}</td>
                                <td class="border px-4 py-2">
                                    <button wire:click="edit({{ $product->id }})"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit</button>
                                    <button wire:click="delete({{ $product->id }})"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="px-4 mt-4">
                    {{$products->links()}}
                </div> --}}
            </div>
        </div>
    </div>
</div>
