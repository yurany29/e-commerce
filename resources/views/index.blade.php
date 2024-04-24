<x-app title="Productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Productos disponibles</h1>
        </div>

			<the-products-list :products="{{ $products }}"/>
    </section>
</x-app>
