<x-app title="Carrito de compras">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>CARRITO DE COMPRAS</h1>
        </div>

			<cart-list :carts="{{$carts}}" />
    </section>
</x-app>