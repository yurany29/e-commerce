<x-app title="Productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
			<h1>DETALLES</h1>
        </div>

			<show-product :product="{{ $product }}"/>
    </section>
</x-app>