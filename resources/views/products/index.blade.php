<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>

<div class="flex justify-center">
    <div class="pt-5">
        <h1 class="text-2xl font-bold">Product List</h1>
    </div>
</div>
<div class="flex justify-center ml-[30%]">
    <div class="p-4" id="product-list">
        @foreach($products as $product)
            <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-[60%]">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <h5 class="mb-2 text-slate-800 text-xl font-semibold">
                            {{ $product->name }}
                        </h5>
                    </div>

                    <p class="text-slate-600 leading-normal font-light mb-4">
                        {{ $product->description }}
                    </p>

                    <span class="rounded-md bg-indigo-700 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md">
                    ${{ $product->price }}
                </span>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof window.Echo !== "undefined") {
            window.Echo.channel("products")
                .listen(".product.added", ({product}) => {
                    const productList = document.getElementById("product-list");
                    const newItem = document.createElement("div");
                    newItem.className = `relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-[60%]`;
                    newItem.innerHTML = `
                        <div class="p-4">
                            <div class="flex justify-between items-center">
                                <h5 class="mb-2 text-slate-800 text-xl font-semibold">
                                    ${product.name}
                                </h5>
                                <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-indigo-700/10 ring-inset">New</span>
                            </div>

                            <p class="text-slate-600 leading-normal font-light mb-4">
                                ${product.description}
                            </p>

                            <span class="rounded-md bg-blue-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md">
                                $${product.price}
                            </span>
                        </div>
                    `;
                    productList.prepend(newItem);
                });
        } else {
            console.error("Echo is not initialized properly.");
        }
    });
</script>

</body>
</html>
