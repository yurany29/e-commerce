<x-app title="Categorias">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>CATEGORIAS</h1>
        </div>

			<the-categories-list :categories="{{ $categories }}"/>
    </section>
</x-app>