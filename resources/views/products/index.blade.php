<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center text-3xl uppercase font-extrabold">
            Welcome To Thunder Store
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- component -->
                <div tabindex="0" class="focus:outline-none">
                    <!-- Remove py-8 -->
                    <div class="mx-auto container py-8">
                        <div class="grid grid-cols-4 grid-gap-4 sm:grid-cols-2 sm:grid-gap-1 md:grid-cols-3 md:grid-gap-2 ">

                            {{-- Cards --}}
                            @foreach ($products as $product)
                            <div tabindex="0" class="flex flex-col space-x-3 focus:outline-none mx-2 w-72 xl:mb-0 mb-8">
                                <div>
                                    <img alt="person capturing an image" src="{{ $product->image }}" tabindex="0"
                                        class="space rounded-lg focus:outline-none w-full h-44" />
                                </div>
                                <div class="bg-white">
                                    <div class="flex items-center justify-between px-4 pt-4">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" tabindex="0"
                                                class="focus:outline-none" width="20" height="20" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 4h6a2 2 0 0 1 2 2v14l-5-3l-5 3v-14a2 2 0 0 1 2 -2"></path>
                                            </svg>
                                        </div>
                                        <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                            <p tabindex="0" class="focus:outline-none text-sm font-medium text-red-700">{{
                                                $product->formatted_price }}</p>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex items-center">
                                            <h2 tabindex="0" class="focus:outline-none text-lg font-semibold">{{
                                                $product->name }}</h2>
                                        </div>
                                        <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-2">{{
                                            $product->description }}</p>

                                        {{-- component Add To Cart --}}
                                        <add-to-cart :product-id="{{ $product->id }}"></add-to-cart>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
