import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductsList from './components/products/TheProductsList.vue'
import TheUsersList from './components/users/TheUsersList.vue'
import TheProductsTable from './components/products/TheProductsTable.vue'
import TheCategoriesList from './components/categories/TheCategoriesList.vue'
import BackendError from './components/Components/BackendError.vue'
import AllProducts from './components/products/AllProducts.vue'
import ShowProduct from './components/products/ShowProduct.vue'
import SearchProducts from './components/search/SearchProducts.vue'
import CartList from './components/cart/CartList.vue'

const app = createApp({
	components: {
		TheProductsList,
		TheUsersList,
		TheProductsTable,
		TheCategoriesList,
		AllProducts,
		ShowProduct,
		SearchProducts,
		CartList,
	}
});


app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app');
