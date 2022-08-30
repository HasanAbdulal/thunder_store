@php
    $orders = auth()->user()->orders;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse ($orders as $order)
                    <table class="table-auto w-full mb-16">
                        <thead class="border-b">
                            <h2>Order n° {{ $order->order_number }} was delivered at {{ $order->created_at->format('d M Y') }}</h2>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    Product name
                                </td>
                                <td class="p-4">
                                    Price
                                </td>
                                <td class="p-4">
                                    Quantity
                                </td>
                            </tr>
                            @foreach($order->products as $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    {{ $product->name }}
                                </td>
                                <td class="p-4">
                                    {{ str_replace('.', ',', $product->pivot->total_price / 100) . ' €' }}
                                </td>
                                <td class="p-4">
                                    {{ $product->pivot->total_quantity }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @empty
                    <h2>You don't have any order yet.</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
