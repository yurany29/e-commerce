<x-app title="Productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>PRODUCTOS</h1>
        </div>

			<the-products-table :products="{{ $products }}" :categories_data="{{ $categories }}"/>
    </section>
</x-app>