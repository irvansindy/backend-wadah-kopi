<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-slot name="header">
        <h2 class="text-left">List Data Transaction</h2>
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
                <input class="form-control mb-3 rounded" type="text" wire:model="search" placeholder="Search" aria-label="search">
                {{-- @if($isModalOpen)
                    @include('livewire.createProduct')
                @elseif ($isModalImageOpen)
                    @include('livewire.uploadImage')
                @endif --}}
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2">Customer Name</th>
                            <th class="px-4 py-2">Grand Total</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="border px-4 py-2">{{ $transaction->id }}</td>
                                <td class="border px-4 py-2">{{ $transaction->user->name }}</td>
                                <td class="border px-4 py-2">{{ number_format($transaction->grand_total,2 , ',', '.') }}</td>
                                <td class="border px-4 py-2">{{ $transaction->status}}</td>
                                <td class="border px-4 py-2">
                                    <div class="content-center">
                                        <button wire:click="edit({{ $transaction->id }})"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Edit</button>
                                        <button wire:click="modalImage({{ $transaction->id }})"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Detail</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-4 mt-4">
                    {{$transactions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
