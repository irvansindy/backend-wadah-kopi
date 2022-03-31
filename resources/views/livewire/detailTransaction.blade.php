<div class="fixed justify-start z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>?
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
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
                        dd($detailTransactions);
                        <ul class="list-none">
                            <li>Now this is a story all about how, my life got flipped turned upside down</li>
                            <!-- ... -->
                        </ul>
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
    </div>
</div>