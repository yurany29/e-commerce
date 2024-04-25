import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductsList from './components/products/TheProductsList.vue'
import TheUsersList from './components/users/TheUsersList.vue'
import TheProductsTable from './components/products/TheProductsTable.vue'
import TheCategoriesList from './components/categories/TheCategoriesList.vue'

const app = createApp({
	components: {
		TheProductsList,
		TheUsersList,
		TheProductsTable,
		TheCategoriesList
	}
});

app.component('v-select', vSelect)
app.mount('#app');
