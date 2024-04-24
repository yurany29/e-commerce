import './bootstrap'
import { createApp } from 'vue'
// import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductsList from './components/products/TheProductsList.vue'

const app = createApp({
	components: {
		TheProductsList
	}
});


app.mount('#app');
