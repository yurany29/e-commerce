<x-app title="Productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
        </div>

			<all-products :products="{{ $products }}" :category="{{ $category }}"/>
    </section>
</x-app>