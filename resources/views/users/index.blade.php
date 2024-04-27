<x-app title="Usuarios">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>USUARIOS</h1>
        </div>

			<the-users-list :users="{{$users}}" :roles_data="{{$roles}}"/>
    </section>
</x-app>